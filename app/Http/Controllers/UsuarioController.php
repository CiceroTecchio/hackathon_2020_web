<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
USE Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::where('cod_escola', Auth::user()->cod_escola)
        ->join('tipos_user','cod_tipo_user', 'tipos_user.id')
        ->where('cod_tipo_user', '>', 1)
        ->select('users.*','tipos_user.descricao')
        ->paginate(10);

        return view('usuarios', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposUsuario = TipoUsuario::where('id', '>', 1)->get();

        return view ('create_usuario', ['tiposUsuario' => $tiposUsuario]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->fill($request->all());
        $usuario->cod_tipo_user = $request->cod_tipo_usuario;
        $usuario->cod_escola = 1;
        if($request->fg_ativo == "on"){
            $usuario->fg_ativo = true;
        }else{
            $usuario->fg_ativo = false;
        }
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        return back()->with('success', 'Usuário cadastrado com sucesso!');
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
        $usuario = User::join('tipos_user','cod_tipo_user', 'tipos_user.id')->select('users.*', 'tipos_user.descricao')->find($id);
        $tiposUsuario = TipoUsuario::where('id', '>', 1)->get();
        
        return view ('edit_usuario', ['usuario' => $usuario, 'tiposUsuario' => $tiposUsuario]);
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
        $usuario = User::find($id);
        $usuario->fill($request->all());
        $usuario->cod_tipo_user = $request->cod_tipo_usuario;
        $usuario->cod_escola = 1;
        if($request->fg_ativo == "on"){
            $usuario->fg_ativo = true;
        }else{
            $usuario->fg_ativo = false;
        }

        if($request->password != null){
            $usuario->password = Hash::make($request->password);
        }
        
        $usuario->save();
        return back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->fg_ativo = !$usuario->fg_ativo;
        $usuario->save();
        return back()->with('success', 'Usuário alterado com sucesso!');
    }
}
