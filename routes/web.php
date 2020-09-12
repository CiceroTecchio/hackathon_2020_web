<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/usuarios', App\Http\Controllers\UsuarioController::class);

Route::resource('/alunos', App\Http\Controllers\AlunoController::class);

Route::resource('/responsavel', App\Http\Controllers\ResponsavelController::class);

Route::get('/busca/turmas', function (Request $request) {
    $query = $request['query'];
    if (strlen($query) > 0) {
        $turmas = DB::table('turmas')
            ->where('descricao', 'like', '%' . $query . '%')
            ->where('cod_escola', Auth::user()->cod_escola)
            ->select('turmas.id as value', 'turmas.descricao as name')
            ->get();
    } else {
        $turmas = DB::table('turmas')
        ->where('cod_escola', Auth::user()->cod_escola)
            ->select('turmas.id as value', 'turmas.descricao as name')
            ->get();
    }

    return ["success" => true, "results" => $turmas];
});


Route::get('/busca/responsavel', function (Request $request) {
    $query = $request['query'];
    if (strlen($query) > 0) {
        $users = DB::table('users')
            ->where('name', 'like', '%' . $query . '%')
            ->where('cod_escola', Auth::user()->cod_escola)
            ->select('users.id as value', 'users.name as name')
            ->get();
    } else {
        $users = DB::table('users')
            ->where('cod_escola', Auth::user()->cod_escola)
            ->select('users.id as value', 'users.name as name')
            ->get();
    }

    return ["success" => true, "results" => $users];
});


Route::get('/busca/alunos', function (Request $request) {
    $query = $request['query'];
    if (strlen($query) > 0) {
        $alunos = DB::table('alunos')
            ->where('nome', 'like', '%' . $query . '%')
            ->where('cod_escola', Auth::user()->cod_escola)
            ->select('alunos.id as value', 'alunos.nome as name')
            ->get();
    } else {
        $alunos = DB::table('alunos')
        ->where('cod_escola', Auth::user()->cod_escola)
            ->select('alunos.id as value', 'alunos.nome as name')
            ->get();
    }

    return ["success" => true, "results" => $alunos];
});