<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\AlunoTurmas;
use Illuminate\Http\Request;
use Auth;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::where('cod_escola', Auth::user()->cod_escola)
        ->paginate(10);

        return view('alunos', ['alunos' => $alunos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('create_aluno');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aluno = new Aluno();
        $aluno->fill($request->all());
        $aluno->cod_escola = Auth::user()->cod_escola;
        if($request->fg_ativo == "on"){
            $aluno->fg_ativo = true;
        }else{
            $aluno->fg_ativo = false;
        }
        $aluno->save();

        if($request->cod_turma != null){
            $turma = new AlunoTurmas();
            $turma->cod_turma = $request->cod_turma;
            $turma->cod_aluno = $aluno->id;
            $turma->cod_escola = Auth::user()->cod_escola;
            $turma->fg_ativo = true;
            $turma->save();
        }

        return back()->with('success', 'Aluno cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = Aluno::find($id);

        $turma = AlunoTurmas::where('alunos_turma.cod_aluno', $id)->join('turmas', 'cod_turma', 'turmas.id')->select('turmas.descricao','turmas.id')->orderBy('alunos_turma.id', 'desc')->first();

        return view ('edit_aluno', ['aluno' => $aluno, 'turma' => $turma]);
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
        $aluno = Aluno::find($id);
        $aluno->fill($request->all());
        $aluno->cod_escola = Auth::user()->cod_escola;
        if($request->fg_ativo == "on"){
            $aluno->fg_ativo = true;
        }else{
            $aluno->fg_ativo = false;
        }
        $aluno->save();

        AlunoTurmas::where('cod_aluno', $aluno->id)
        ->update(['fg_ativo' => false]);

        if($request->cod_turma != null){
            $turma = new AlunoTurmas();
            $turma->cod_turma = $request->cod_turma;
            $turma->cod_aluno = $aluno->id;
            $turma->cod_escola = Auth::user()->cod_escola;
            $turma->fg_ativo = true;
            $turma->save();
        }
        return back()->with('success', 'Aluno editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = Aluno::find($id);
        $aluno->fg_ativo = !$aluno->fg_ativo;
        $aluno->save();
        return back()->with('success', 'Aluno alterado com sucesso!');
    }
}
