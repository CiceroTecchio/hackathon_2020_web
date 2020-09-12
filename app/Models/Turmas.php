<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turmas extends Model
{
    use HasFactory;

    protected $table = 'turmas';

    protected $fillable = [
        'descricao', 'cod_escola', 'fg_ativo'
    ];
}
