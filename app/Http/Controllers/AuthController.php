<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('correo', $request->correo)
                          ->where('activo', true)
                          ->first();

        if ($usuario && \Hash::check($request->password, $usuario->hash_password)) {
            Auth::login($usuario, $request->boolean('remember'));
            $request->session()->regenerate();

            // Redirigir según el tipo de usuario
            if ($usuario->isAdmin()) {
                return redirect()->intended(route('usuarios.index'));
            }

            return redirect()->intended(route('bienes.index'));
        }

        return back()->with('error', 'Las credenciales no coinciden con nuestros registros')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}


