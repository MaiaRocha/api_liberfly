<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
        /**
     * Logar usuario.
     *
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Auth"},
     *     operationId="Login",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
                        @OA\Property(
     *                     property="email",
     *                     description="Email",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Senha",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function login(Request $request) {

        $email = $request->email;
        $password = $request->password;

        $token = auth()->attempt([
            'email' => $email,
            'password' => $password
        ]);

        if(!$token) {
            return response()->json(['errors' => ['Unauthorized']], 401);
        }

        $tokenResponse = $this->respondWithToken($token);
        return $tokenResponse;
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600
        ]);
    }
}
