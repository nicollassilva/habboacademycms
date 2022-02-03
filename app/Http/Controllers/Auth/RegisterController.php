<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\User\UserBan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('habboacademy.auth.register');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $usesCaptcha = config('academy.site.register.captchaActivated', false);
        
        $this->checkActivatedRegister();
        $this->checkActivatedMaintenance();

        $this->userHasBeenIpBanned();
        $this->checkAccountsByIP();

        $validations = [
            'username' => ['required', 'string', 'min:3', 'max:50', 'unique:users', 'regex:/^([À-üA-Za-z\.:_\-0-9\!]+)$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];

        if($usesCaptcha) {
            $validations['g-recaptcha-response'] = ['recaptcha'];
        }

        return Validator::make($data, $validations);
    }

    /**
     * @return void
     */
    public function checkActivatedRegister(): void
    {
        $registerActivated = config('academy.site.register.activated', true);

        if(!$registerActivated) {
            throw ValidationException::withMessages([
                'username' => 'O registro de novas contas foi desabilitado pelo administrador.',
            ]);
        }
    }

    /**
     * @return void
     */
    public function checkActivatedMaintenance(): void
    {
        $maintenance = config('academy.site.maintenance', false);

        if($maintenance) {
            throw ValidationException::withMessages([
                'username' => 'O site está passando por uma manutenção e o registro de contas foi desativado.',
            ]);
        }
    }

    /**
     * @return void
     */
    public function checkAccountsByIP(): void
    {
        $accountLimits = config('academy.site.register.accountsPerIp', 10);
        $accounts = User::where('ip_register', \Request::ip())->count();

        if($accounts >= $accountLimits) {
            throw ValidationException::withMessages([
                'username' => 'Você excedeu o total de contas permitidas por IP.',
            ]);
        }
    }

    /**
     * @return void
     */
    public function userHasBeenIpBanned(): void
    {
        $userBannedByIp = UserBan::userHasBeenIpBanned();

        if($userBannedByIp) {
            throw ValidationException::withMessages([
                'username' => 'Você está banido por IP e não pode criar novas contas!',
            ]);
        }
    }
    
    /**
     * @return void
     */
    public function checkBlockedUsernames(?string $username): void
    {
        $blockedUsernames = config('academy.site.register.blockedUsernames', []);

        if(in_array($username, $blockedUsernames)) {
            throw ValidationException::withMessages([
                'username' => 'Não é possível criar uma conta com esse nome de usuário.',
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $this->checkBlockedUsernames($data['username']);

        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'ip_register' => \Request::ip(),
            'ip_last_login' => \Request::ip(),
            'last_login' => \Carbon\Carbon::now(),
            'password' => Hash::make($data['password']),
        ]);
    }
}
