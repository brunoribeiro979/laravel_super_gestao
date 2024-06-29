<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    use HasFactory;
    protected $table = 'produto_detalhes';
    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'produto_id', 'id');
        // ja aqui em belongsTo fica assim: primeiro parametro após a classe eh a FK dessa mesma tabela 'produto_detalhes' e o segundo parametro é 'id' que refere-se ao id da tabela que esse registro pertence que no caso eh a tabela 'produtos0'
    }
}
