<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'movimentacao';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'descricao',
        'qtd_valor',
        'tipo_movimentacao',
        'dt_transacao',
    ];

    protected $casts = [
        'dt_transacao' => 'date',
        'qtd_valor' => 'decimal:2',
    ];
}
