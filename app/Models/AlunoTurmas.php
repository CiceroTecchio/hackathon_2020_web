<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoTurmas extends Model
{
    use HasFactory;

    protected $table = 'alunos_turma';

    protected $fillable = [
        'cod_turma', 'cod_aluno'
    ];
}
