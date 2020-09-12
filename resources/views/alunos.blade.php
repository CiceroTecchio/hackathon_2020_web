@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="ui center aligned header">
                <i class="users icon"></i>
                Lista de Alunos
            </h2>
            @if (session('success'))
            <div class="ui positive message">
                <i class="close icon"></i>
                <div class="header">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            <a href="{{ route('alunos.create') }}" class="ui inverted green button">
                <i class="icon user plus"></i>
                Adicionar
            </a>
            <div class="card">

                <div class="table-responsive-lg">
                    <table class="ui sortable table unstackable celled" width="100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-Mail</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>RA</th>
                                <th class="collapsing center aligned no-sort">Editar</th>
                                <th class="collapsing center aligned no-sort">Ativar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($alunos) < 1) <tr>
                                <td colspan="6">
                                    <h2 class="ui center aligned header">
                                        <i class="info icon"></i>
                                        Nenhum usuário
                                    </h2>
                                </td>
                                </tr>
                                @endif

                                @foreach($alunos as $usuario)

                                <tr>
                                    <td>{{$usuario->nome}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td>{{$usuario->cpf}}</td>
                                    <td>{{$usuario->telefone}}</td>
                                    <td>{{$usuario->ra}}</td>
                                    <td class="selectable center aligned">
                                        <a href="{{route('alunos.edit', $usuario->id)}}">
                                            <i class="inverted blue edit icon"></i>
                                        </a>
                                    </td>
                                    <form id="formAtivar{{$usuario->id}}" action="{{route('alunos.destroy', $usuario->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <td class="selectable center aligned">
                                            <a href="#" onclick="document.getElementById('formAtivar{{$usuario->id}}').submit(); return false;">
                                                <i class="inverted @if($usuario->fg_ativo == true) green @else red @endif circle icon"></i>
                                            </a>
                                        </td>
                                    </form>

                                </tr>

                                @endforeach

                        </tbody>

                    </table>
                    @if ($alunos->lastPage() > 1)
                    <div class="ui pagination menu">
                        <a href="{{ $alunos->previousPageUrl() }}" class="{{ ($alunos->currentPage() == 1) ? ' disabled' : '' }} item">
                            Anterior
                        </a>
                        @for ($i = 1; $i <= $alunos->lastPage(); $i++)
                            <a href="{{ $alunos->url($i) }}" class="{{ ($alunos->currentPage() == $i) ? ' active' : '' }} item">
                                {{ $i }}
                            </a>
                            @endfor
                            <a href="{{ $alunos->nextPageUrl() }}" class="{{ ($alunos->currentPage() == $alunos->lastPage()) ? ' disabled' : '' }} item">
                                Próximo
                            </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $('.ui.table').tablesort();
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade');
        });
</script>
@endsection