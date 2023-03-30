<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
            /**
     * Listar usuarios.
     *
     * @OA\Get(
     *     path="/users/",
     *     tags={"Users"},
     *     operationId="Listar",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    // Metodo que lista usuários
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users, 200);
        } catch (Exception $e) {
            return response()->json(['errors' => ['Erro ao listar usuários']], 400);
        }
    }

                /**
     * Criar usuarios.
     *
     * @OA\Post(
     *     path="/users/",
     *     tags={"Users"},
     *     operationId="Criar",
     *     @OA\Response(
     *         response=201,
     *         description="successful operation"
     *     ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
                        @OA\Property(
     *                     property="name",
     *                     description="Nome",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Senha",
     *                     type="string"
     *                 ),
     *                         @OA\Property(
     *                     property="email",
     *                     description="Email",
     *                     type="string",
     *                 ),
     *                         @OA\Property(
     *                     property="cpf",
     *                     description="cpf",
     *                     type="string",
     *                 ),
     *                         @OA\Property(
     *                     property="telephone",
     *                     description="telefone",
     *                     type="string",
     *                 ),
     *             )
     *         )
     *     )
     * )
     */

    // Metodo que cria usuário
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->all();

            $user = new User();
            $user->name = $data['name'];
            $user->password = Hash::make($data['password']);
            $user->email = $data['email'];
            $user->cpf = preg_replace('/[^0-9]/', '', $data['cpf']);
            $user->telephone = preg_replace('/[^0-9]/', '', $data['telephone']);;
            $user->save();

            return response()->json($user, 201);

        } catch (Exception $e) {
            return $e;
            return response()->json(['errors' => ['Erro ao criar o usuário']], 400);
        }
    }

                    /**
     * listar usuário pelo ID.
     *
     * @OA\Get(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     operationId="Listar Pelo ID",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */

    // Metodo que lista usuário pelo ID
    public function show($id)
    {
        try {
            $users = User::findOrFail($id);
            return response()->json($users, 200);
        } catch (Exception $e) {
            return response()->json(['errors' => ['Erro ao listar o usuário']], 400);
        }
    }
}
