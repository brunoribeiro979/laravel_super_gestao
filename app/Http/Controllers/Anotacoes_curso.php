<?php
// ELOQUENTE
// forma de salvar no banco registros sem instanciar objeto
Fornecedor::create(['nome' => 'Fornecedor ABC', 'site' => 'fornecedor.com.br', 'uf' => 'sp', 'email' => 'email@email.com']);

// um select na tabela que traz todos os registros
Fornecedor::all();

// select pela primary key, sempre o id, e podemos passar um array de ids tbm
Fornecedor::find($id);
Fornecedor::find([$id, $id2, $id3]);

Fornecedor::where('id', $id)->first();

Fornecedor::where('id', '>=', 1)->get();

Fornecedor::where('id', '<>', $id)->first();

Fornecedor::where('mensagem', 'like', '%noite%')->get();

// retorna collection com motivo_contato igual a 1 e 3
SiteContato::whereIn('motivo_contato', [1, 3])->get();

// ja esse retorna dados que motivo_contato nao seja nem 1 nem 3
SiteContato::whereNotIn('motivo_contato', [1, 3])->get();

// retorna os contatos cujo id estejam entre 3 e 6 (BETWEEN É USADO PARA VALORES NUMERICOS E DATAS)
SiteContato::whereBetween('id', [3, 6])->get();

// ja esse retorna contatos que nao esteja entre os ids 3 e 6 (BETWEEN É USADO PARA VALORES NUMERICOS E DATAS)
SiteContato::whereNotBetween('id', [3, 6])->get();

// mais de uma comparacao, no caso abaixo todos os wheres servem como and
SiteContato::where('nome', '<>', 'Fernando')->whereIn('motivo_contato', [1, 2])->whereBetween('created_at', ['2020-08-01 0
0:00:00', '2020-08-31 23:59:59'])->get();

// no caso abaixo usamos OR
SiteContato::where('nome', '<>', 'Fernando')->orWhereIn('motivo_contato', [1, 2])->orWhereBetween('created_at', ['2020-0
8-01 00:00:00', '2024-08-31 23:59:59'])->get();

// retorna os dados onde a coluna updated_at tenha registros marcados com NULL
SiteContato::whereNull('updated_at')->get();

// ja o caso abaixo retorna os dados onde a coluna updated_at tenha dados nao nulos/preenchidos
SiteContato::whereNotNull('updated_at')->get();

// pesquisa pela data(a coluna precisa ser do tipo date ou timestamp)
SiteContato::whereDate('created_at', '2024-05-24')->get();

// pesquisa pelo dia(a coluna precisa ser do tipo date ou timestamp)
SiteContato::whereDay('created_at', '24')->get();

// pesquisa pelo mes(a coluna precisa ser do tipo date ou timestamp)
SiteContato::whereMonth('created_at', '05')->get();

// pesquisa pelo ano(a coluna precisa ser do tipo date ou timestamp)
SiteContato::whereYear('created_at', '2024')->get();

// pesquisa pela hora(a coluna precisa ser do tipo date ou timestamp)
SiteContato::whereTime('created_at', '=', '21:54:20')->get();

// pesquisa nas duas colunas e retorna os registros onde as duas colunas tiverem o mesmo dado
SiteContato::whereColumn('created_at', 'updated_at')->get();

// pesquisa nas duas colunas e retorna os registros onde as duas colunas forem diferentes
SiteContato::whereColumn('created_at', '<>', 'updated_at')->get();

// agrupando consultas com parenteses exemplo (nome = 'Jorge' OR nome = 'Ana') AND (motivo_contato IN(1,2) OR id BETWEEN 4 AND 6);
SiteContato::where(function ($query) {
    $query->where('nome', 'Jorge')->orWhere('nome', 'Ana');
})->where(function ($query) {
    $query->whereIn('motivo_contato', [1, 2])->orWhereBetween('id', [4, 6]);
})->get();

// ordenacao, por padrao eh o asc e caso seja nem precisa colocar o segundo parametro, podemos encadear tbm ordenacoes
SiteContato::orderBy('nome')->get();
SiteContato::orderBy('nome', 'desc')->get();
SiteContato::orderBy('motivo_contato')->orderBy('nome', 'desc')->get();

// retorna o primeiro
SiteContato::where('id', '>', '1')->first();

// retorna o ultimo
SiteContato::where('id', '>', '1')->last();

// inverte a ordem
SiteContato::where('id', '>', '1')->reverse();

// transforma em array
SiteContato::all()->toArray();

// transforma em json
SiteContato::all()->toJson();

// metodo pluck vai retornar no caso abaixo apenas os nomes e emails dos usuarios em um array associativo
SiteContato::all()->pluck('email', 'nome');

// para o fill abaixo funcionar, la no model as colunas precisam estar em protected fillable,
$forn2->fill(['nome' => 'For 789', 'site' => 'site.com.br', 'email' => 'newemail@email.com'])->save();

// faz um update, NAO precisa colocar o ->save() no final
Fornecedor::whereIn('id', [1, 2])->update(['nome' => 'Fornecedor teste', 'site' => 'teste.com.br']);

// deteta da tabela
SiteContato::find(4)->delete();

// outra forma de deletar com destroy, passando o id para ser excluido
SiteContato::destroy(5);

// deleta do banco caso a tabela esteja com softdelete, exclui realmente o dado do banco
$forn2->forceDelete();

// retorna os registros que foram deletados pelo softdelete e os que nao foram deletados tbm
Fornecedor::withTrashed()->get();

// agora esse abaixo retornara apenas os que foram excluidos e tem o softdelete
Fornecedor::onlyTrashed()->get();

// cria a seeder
php artisan make:seeder SiteContatoSeeder;

// roda as seeders
php artisan db:seed;

// roda uma seeder especifica
php artisan db:seed --class=SiteContatoSeeder;

// criando factory
php artisan make:factory SiteContatoFactory --model=SiteContato;

// para dar um print_r nos atributos vindos do request
print_r($contato->getAttributes());

  // outra forma de salvar no banco abaixo
  $contato2 = new SiteContato();
  // para o fill dar certo, la no model precisa colocar o protected fillable com as colunas
  $contato2->fill($request->all());
  $contato2->save();

// outra forma ainda mais simples de salvar no banco
$contato2->create($request->all());

// estrutura de erros
@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

// preencher dado no input caso o validate nao de certo, use o old no value
<input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
<textarea name="mensagem" class="{{ $classe }}" placeholder="Preencha aqui a sua mensagem">{{ old('mensagem') }}</textarea>


// mostrar o erro do input logo abaixo dele
<input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
@if ($errors->has('nome'))
    {{ $errors->first('nome') }}
@endif
// tem uma forma mais enxuta com operador ternario
{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}



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

// criar middleware
    php artisan make:middleware LogAcessoMiddleware


// posso chamar as middlewares tbm nos controllers, criando uma funcao construtura la dentro do controller
public function __construct()
{
    $this->middleware(LogAcessoMiddleware::class);
}

php artisan make:controller --resource ProdutoDetalheController
// cria o controller com os metodos principais ja setados

Route::resource('produto-detalhe', ProdutoDetalheController::class);
// cria a rota resource para os metodos setados acima

// CONVENCAO DE METODOS NOS CONTROLADORES
index() /* exibe lista de registros */
create() /* exibir formulario de criacao de registro */
store() /* receber formulario de criacao de registro */
show() /* exibir um registro especifico */
edit() /* exibir formulario de edicao do registro */
update() /* receber formulario de edicao do registro */
destroy() /* receber dados para remoção do registro */

GET /* buscar dados */
POST /* inserir dados no banco */
DELETE /* deletar dados */
PUT e PATCH /* atualizar dados, update */
/* o PUT atualiza o objeto todo ja o PATCH não, apenas alguns dados */

<form action="{{ route('produto.update', ['produto' => $produto->id]) }}" method="post">
@csrf
@method('PUT')
/* pra enviar formularios do tipo put o form fica como post e eh adicionado @method('PUT') */




// exemplo de formatacao de data na view
<td>{{ $produto->pivot->created_at->format('d/m/Y') }}</td>
