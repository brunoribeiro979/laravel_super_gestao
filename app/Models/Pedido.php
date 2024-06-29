<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function produtos()
    {
        // return $this->belongsToMany(Produto::class, 'pedidos_produtos');
        return $this->belongsToMany(Item::class, 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('created_at', 'updated_at', 'id');

        /*
            1- Modelo do relacionamento NxN em relação ao modelo que estamos implementando
            2- Tabela auxiliar que armazena os registros de relacionamento
            3- Nome da FK da tabela mapeada pelo model na tabela de relacionamento
            4- Nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
        */
    }
}
