<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta_Orcamentaria extends Model
{
    protected $fillable = [
        'user_id', 
        'nome',
        'valor',
        'saldo',
        'dataFinal',
        'situacao'
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'meta_orcamentarias';
}
