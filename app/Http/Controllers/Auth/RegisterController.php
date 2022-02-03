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
        $academySettings = [
            'registerActivated' => config('academy.site.register.activated', true),
            'maxAccountsByIp' => config('academy.site.register.accountsPerIp', 10),
            'usesCaptcha' => config('academy.site.register.enableCaptcha', false),
            'maintenance' => config('academy.site.maintenance', false)
        ];

        if(!$academySettings['registerActivated']) {
            throw ValidationException::withMessages([
                'username' => 'O registro de novas contas foi desabilitado pelo administrador.',
            ]);
        }

        if($academySettings['maintenance']) {
            throw ValidationException::withMessages([
                'username' => 'O site está passando por uma manutenção e o registro de contas foi desativado.',
            ]);
        }

        $accounts = User::where('ip_register', \Request::ip())->count();

        if($accounts >= $academySettings['maxAccountsByIp']) {
            throw ValidationException::withMessages([
                'username' => 'Você excedeu o total de contas permitidas por IP.',
            ]);
        }

        $userBannedByIp = UserBan::userHasBeenIpBanned();

        if($userBannedByIp) {
            throw ValidationException::withMessages([
                'username' => 'Você está banido por IP e não pode criar novas contas!',
            ]);
        }

        $validations = [
            'username' => ['required', 'string', 'min:3', 'max:50', 'unique:users', 'regex:/^([À-üA-Za-z\.:_\-0-9\!]+)$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];

        if($academySettings['usesCaptcha']) {
            $validations['g-recaptcha-response'] = ['recaptcha'];
        }

        return Validator::make($data, $validations);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
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
