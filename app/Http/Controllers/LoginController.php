<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = $request->erro;
        if ($erro == 1) {
            $erro = 'Usuário ou senha não existe!';
        }
        if ($erro == 2) {
            $erro = 'Necessário realizar login para ter acesso a essa página!';
        }
        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request)
    {
        // regras de validacao
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        // mensagens de feedback de validacao
        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!'
        ];

        $request->validate($regras, $feedback);

        // recuperamos os parametros do formulario
        $email = $request->usuario;
        $password = $request->senha;

        // iniciar o model user
        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if (isset($usuario->name)) {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair()
    {
        session_destroy();
        return redirect()->route('site.index');
    }
}
