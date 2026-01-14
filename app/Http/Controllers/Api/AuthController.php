<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- ¡Importante!
use App\Models\User; // <-- ¡Importante!

class AuthController extends Controller
{
    /**
     * Maneja la petición de inicio de sesión de la API.
     */
    public function login(Request $request)
    {
        // 1. Validar la entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // 2. Intentar autenticar al usuario
        // Auth::attempt() hace todo el trabajo: hashea la contraseña y la compara
        if (!Auth::attempt($credentials)) {
            // 3. Si falla, devolver un error 401 (No autorizado)
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        // 4. Si tiene éxito, obtener el usuario y crear un token
        $user = $request->user(); // O $user = Auth::user();
        
        // Revocamos tokens antiguos (opcional, pero buena seguridad)
        $user->tokens()->delete(); 

        // Creamos el nuevo token
        $token = $user->createToken('token-para-app-movil')->plainTextToken;

        // 5. Devolver una respuesta exitosa con el token y los datos del usuario
        return response()->json([
            'message' => 'Login exitoso',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $token,
        ]);
    }

    /**
     * Maneja la petición de cierre de sesión de la API.
     */
    public function logout(Request $request)
    {
        // Revoca el token que se usó para hacer esta petición
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}