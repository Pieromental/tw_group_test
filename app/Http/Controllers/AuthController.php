<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\GeneralException;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Utils\Response;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function login(Request $request)
    {
        try {
          
            $request->validate([
                'userId' => 'required',
                'password' => 'required',
            ]);

            $credentials = [
                'user_id' => $request->input('userId'),
                'password' => $request->input('password')
            ];

            // Verificar si el usuario está activo
            $user = User::where('user_id', $credentials['user_id'])
                ->where('active', 1)
                ->first();

            if (!$user) {
                return response()->json([
                    'code' => 400,
                    'title' => 'Usuario No Encontrado',
                    'message' => 'Usuario y/o Contraseña Inválidos',
                ], 400);
            }

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'code' => 400,
                    'title' => 'Credenciales Incorrectas',
                    'message' => 'Usuario y/o Contraseña Inválidos',
                ], 400);
            }

            // Retornar la respuesta con el token y los datos del usuario
            return response()->json([
                'code' => 200,
                'title' => 'Login Exitoso',
                'message' => 'Inicio de sesión exitoso',
                'data' => [
                    'usuario' => $user,
                    'token' => $token
                ]
            ], 200);
        } catch (GeneralException $e) {
            $functionName = __FUNCTION__;
            return Response::error(code: $e->getCode(), message: $e, functionName: $functionName);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // /**
    //  * Refresh a token.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    // /**
    //  * Get the token array structure.
    //  *
    //  * @param  string $token
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60
    //     ]);
    // }
}
