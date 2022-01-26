<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->disabled) {
            $this->logout($request, true);

            throw ValidationException::withMessages([
                $this->username() => 'Sua conta foi desativada!',
            ]);
        }

        $userBans = $user->bans();

        if($userBans->count()) {
            $userBans->each(function($userBan) use ($request) {
                if($userBan->expires_at !== null && $userBan->expires_at->lte(\Carbon\Carbon::now())) return;

                $this->logout($request, true);
    
                throw ValidationException::withMessages([
                    $this->username() => "Seu usuário foi banido! Motivo: {$userBan->ban_reason}",
                ]);
            });
        }

        $user->logs()->create([
            'ip' => $request->ip(),
            'content' => "Fez login no site",
            'browser' => $request->header('User-Agent')
        ]);
    }

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
}
