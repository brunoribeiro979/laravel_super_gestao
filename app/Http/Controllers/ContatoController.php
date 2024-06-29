<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        // print_r($request->all());

        // $contato = new SiteContato();
        // $contato->nome = $request->nome;
        // $contato->telefone = $request->telefone;
        // $contato->email = $request->email;
        // $contato->motivo_contato = $request->motivo_contato;
        // $contato->mensagem = $request->mensagem;

        // $contato->save();

        // outra forma de salvar no banco abaixo
        // $contato2 = new SiteContato();
        // para o fill dar certo, la no model precisa colocar o protected fillable com as colunas, o name precisa ta igual as colunas
        // $contato2->create($request->all());
        // $contato2->save();

        // print_r($contato->getAttributes());

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'contato', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        // realizar a validação dos dados do formulario
        $request->validate(
            [
                'nome' => 'required|min:3|max:40|unique:site_contatos',
                'telefone' => 'required',
                'email' => 'email',
                'motivo_contatos_id' => 'required',
                'mensagem' => 'required|max:2000'
            ],
            [
                'nome.required' => 'O campo nome é obrigatório',
                'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'nome.unique' => 'O nome informado já está em uso',
                'telefone.required' => 'O campo telefone é obrigatório',

                'email' => 'O email informado não é valido',
                'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',
                'required' => 'O campo :attribute deve ser preenchido'
            ]
        );

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
