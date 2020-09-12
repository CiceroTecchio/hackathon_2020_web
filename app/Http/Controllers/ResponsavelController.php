<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Responsavel;
use Illuminate\Http\Request;

class ResponsavelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsavel = Responsavel::join('alunos','cod_aluno', 'alunos.id')
        ->join('users','cod_responsavel', 'users.id')
        ->select('responsaveis.id','users.name as responsavel','alunos.nome as aluno')
        ->paginate(10);

        return view('responsaveis', ['responsaveis' => $responsavel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('create_responsavel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $responsavel = new Responsavel();
        $responsavel->cod_aluno = $request->cod_aluno;
        $responsavel->cod_responsavel = $request->cod_responsavel;
        $responsavel->save();
        
        return back()->with('success', 'Responsável criado com sucesso!');
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
        $responsavel= Responsavel::join('alunos','cod_aluno', 'alunos.id')
        ->join('users','cod_responsavel', 'users.id')
        ->select('responsaveis.id','cod_aluno', 'alunos.nome as nome_aluno','cod_responsavel', 'users.name as nome_responsavel')
        ->find($id);

        return view ('edit_responsavel', ['responsavel' => $responsavel]);
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
        $responsavel = Responsavel::find($id);
        $responsavel->cod_aluno = $request->cod_aluno;
        $responsavel->cod_responsavel = $request->cod_responsavel;
        $responsavel->save();
        
        return redirect('/responsavel')->with('success', 'Responsável alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responsavel = Responsavel::find($id);
        $responsavel->delete();

        return back()->with('success', 'Responsável removido com sucesso!');
    }
}
