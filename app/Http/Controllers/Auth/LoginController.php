<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Validar SOLO email
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    }

    /**
     * Login manual SIN password
     */
    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            Auth::login($user, true);
            return true;
        }

        return false;
    }

    /**
     * Desactivar throttling por password
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => ['El correo no está registrado.'],
        ]);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
