<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%' . $request->nome . '%')
            ->where('site', 'like', '%' . $request->site . '%')
            ->where('uf', 'like', '%' . $request->uf . '%')
            ->where('email', 'like', '%' . $request->email . '%')
            ->paginate(7);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {
        $msg = '';
        // INCLUSÃO
        if ($request->_token != '' && $request->id == '') {
            // validacao de dados
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido.',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo UF deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo UF deve ter no máximo 2 caracteres',
                'email' => 'Preencha um email válido.'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso!';
        }

        // EDIÇÃO
        if ($request->_token != '' && $request->id != '') {
            $fornecedor = Fornecedor::find($request->id);
            $update = $fornecedor->update($request->all());

            if ($update) {
                $msg = 'Cadastro editado com sucesso!';
            } else {
                $msg = 'Problema ao editar!';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->id, 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '')
    {

        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete();

        return redirect()->route('app.fornecedor');
    }
}
