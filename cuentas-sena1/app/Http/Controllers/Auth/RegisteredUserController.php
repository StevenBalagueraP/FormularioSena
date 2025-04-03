<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Notifications\CustomVerifyEmail;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Procesa la solicitud de registro.
     *
     * @throws \Illuminate\Validation\ValidationException
     *la que procesa lo que el formualrio envìa
     * get debuelven formularios vistas
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'usuario' => 'required|string|max:255|unique:users,usuario',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'telefono' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'usuario' => $request->usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => strtolower($request->email),
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),// encriptar la contraseña 
        
        ]);

        event(new Registered($user));

        // No hacer login automático si requieres verificación
        if (config('auth.must_verify_email')) {
            return redirect()->route('verification.notice');
        }

        $user->notify(new \App\Notifications\CustomVerifyEmail);


        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
