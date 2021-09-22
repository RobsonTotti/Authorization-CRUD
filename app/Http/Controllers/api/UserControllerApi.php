<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserControllerApi extends Controller
{
	public function login(Request $request)
	{
		try {

			// Verifica se os dados foram preenchidos
			if (
				!$request->has('email') ||
				!$request->has('password')
			) {
				return response()->json(["status" => 500, "mensagem" => "Preencha todos os dados"], 500);
			}

			$users = User::all();
			foreach ($users as $u) {
				if (
					$request->email == $u->email &&
					Hash::check($request->password, $u->password)
				) {
					$user            = User::find($u->id);
					$user->api_token = Str::random(60);
					$user->save();

					return response()->json(["token" => $user->api_token, "id" => $user->id, "nome" => $user->name], 200);
				}
			}
			return response()->json(["status" => 401, "mensagem" => "Usuário ou senha incorretos"], 401);
		} catch (\Illuminate\Database\QueryException $e) {
			return response()->json(["status" => 500, "mensagem" => "Não foi possível realizar o login! Tente novamente mais tarde"], 500);
		}
	}

	public function salvarUsuario(Request $request)
	{
		// Verifica se os dados foram preenchidos
		if (
			!$request->has('name') ||
			!$request->has('email') ||
			!$request->has('password')
		) {
			return response()->json(["status" => 500, "mensagem" => "Preencha todos os dados"], 500);
		}

		// Verifica se já existe alguem com este mesmo 'usuario', e se existe avisa o usuário
		$usuarios = User::all();
		foreach ($usuarios as $u) {
			if ($request->email == $u->email) {
				return response()->json(["status" => 400, "mensagem" => "Já existe alguém cadastrado com esse mesmo email"], 400);
			}
		}

		try {
			// Salva o usuário
			$user = new User();
			$user->fill($request->all());
			$user->password = bcrypt($user->password);
			$user->save();
			return response()->json(["status" => 201, "mensagem" => "Usuário cadastrado com sucesso!"], 201);
		} catch (\Illuminate\Database\QueryException $ex) {
			return response()->json(["status" => 500, "mensagem" => "Não foi possível cadastrar o usuário! Tente novamente mais tarde"], 500);
		}
	}
}
