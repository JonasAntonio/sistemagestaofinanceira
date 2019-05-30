<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartao_Credito extends Model
{
    protected $fillable = [
        'user_id', 
        'nome',
        'limite',
        'bandeira',
        'diaPagamento',
        'diaFechamento'
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'cartao_creditos';
}
