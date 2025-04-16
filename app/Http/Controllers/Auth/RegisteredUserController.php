<?php

// Declaramos el espacio de nombres para ubicar este controlador dentro de la carpeta Auth
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Importamos la clase base de todos los controladores
use App\Models\User; // Importamos el modelo de Usuario
use App\Providers\RouteServiceProvider; // Importamos la ruta a donde se redirige tras login/registro
use Illuminate\Auth\Events\Registered; // Evento que se dispara cuando un usuario se registra
use Illuminate\Http\RedirectResponse; // Tipo de respuesta HTTP para redireccionamientos
use Illuminate\Http\Request; // Maneja la solicitud HTTP entrante
use Illuminate\Support\Facades\Auth; // Nos da acceso a la autenticación
use Illuminate\Support\Facades\Hash; // Para encriptar contraseñas
use Illuminate\Validation\Rules; // Acceso a reglas de validación de contraseña
use Illuminate\View\View; // Tipo de respuesta para retornar vistas

// Este controlador maneja el proceso de registro de nuevos usuarios
class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     * GET /register
     */
    public function create(): View
    {
        // Retorna la vista de registro: resources/views/auth/register.blade.php
        return view('auth.register');
    }

    /**
     * Procesa una solicitud de registro entrante (POST /register).
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    { 
        // ✅ Valida los datos del formulario
        // name: requerido, string, máximo 255 caracteres
        // email: requerido, string, en minúscula, formato email, único
        // password: requerido, confirmado (password_confirmation debe coincidir), con reglas por defecto
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        // 🧑‍💻 Crea un nuevo usuario en la base de datos
        // La contraseña se encripta con Hash::make()
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 🚨 Dispara un evento de "usuario registrado" (puede ser usado para enviar emails de verificación, por ejemplo)
        event(new Registered($user));

        // 🔐 Inicia sesión automáticamente al usuario registrado
        Auth::login($user);

        // 🔁 Redirecciona al usuario al dashboard u otra ruta definida como HOME
        return redirect(RouteServiceProvider::HOME);
    }
}
