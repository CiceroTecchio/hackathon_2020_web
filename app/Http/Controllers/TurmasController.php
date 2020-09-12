<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlunoTurmas;
use App\Models\Turmas;
use Illuminate\Http\Request;

class TurmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turmas = Turmas::select('id', 'descricao')->where('cod_escola', 1)->where('fg_ativo', true)->get();

        return response()->json(['response' => 'Sucesso', 'turmas' => $turmas], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alunos = AlunoTurmas::join('alunos', 'cod_aluno', 'alunos.id')
            ->select('alunos.id', 'alunos.nome')
            ->where('alunos_turma.cod_turma', $id)
            ->where('alunos_turma.fg_ativo', true)
            ->get();

            return response()->json(['response' => 'Sucesso', 'alunos' => $alunos], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
