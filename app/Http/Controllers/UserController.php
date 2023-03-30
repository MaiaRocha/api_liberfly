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
