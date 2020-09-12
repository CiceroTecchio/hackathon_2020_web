<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ListaPresenca;
use App\Models\Presenca;
use App\Models\Responsavel;
use Illuminate\Http\Request;
use Mail;

class PresencaController extends Controller
{

    public function cadastraPresença(Request $request)
    {   
        ListaPresenca::where('cod_presenca',$request->cod_presenca)->where('cod_aluno',$request->cod_aluno)->delete();
        $presenca = new ListaPresenca();
        $presenca->cod_presenca = $request->cod_presenca;
        $presenca->cod_aluno = $request->cod_aluno;
        $presenca->fg_presente = $request->presente;
        $presenca->save();

        if($request->presente == false){
            $responsaveis = Responsavel::where('cod_aluno', $request->cod_aluno)->join('users','cod_responsavel', 'users.id')->join('alunos', 'cod_aluno', 'alunos.id')
            ->select('users.email','alunos.nome')->get();

            foreach($responsaveis as $responsavel){
                \Mail::send('/email',['nome' => $responsavel->nome], function ($message) use ($responsavel) {
                    $message->from('vigiatech001@gmail.com', 'VigiaTech')
                        ->to($responsavel->email)
                        ->subject($responsavel->nome.' não esteve presente na chamada!');
                });
            }
            
        }
        

        return response()->json(['response' => 'Presença Criada', 'ativo' => $presenca->fg_presente], 201);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $presenca = new Presenca();
        $presenca->dia = date('Y-m-d');
        $presenca->cod_turma = $request->cod_turma;
        $presenca->cod_professor = 1;
        $presenca->save();

        return response()->json(['response' => 'Presença Criada', 'id' => $presenca->id], 201);
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
