<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    public function itemDetalhe()
    {
        return $this->hasOne(ItemDetalhe::class, 'produto_id', 'id');
        // Produto tem 1 produtoDetalhe
        // explicando no hasone os parametros da funcao hasOne() acima:
        // a tabela 'produtos' tem um item detalhe, primeiro parametro após a classe eh 'produto_id' que é a FK,o segundo parametro 'id' é o id dessa tabela 'produtos'
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedidos_produtos', 'produto_id', 'pedido_id');

        /*
        3- Representa o nome da FK da tabela mapeada pelo model na tabela de relacionamento
        4- Representa o nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
        */
    }
}
