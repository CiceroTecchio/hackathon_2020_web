@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="ui center aligned header">
                <i class="users icon"></i>
                Lista de Usuários
            </h2>
            @if (session('success'))
            <div class="ui positive message">
                <i class="close icon"></i>
                <div class="header">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            <a href="{{ route('usuarios.create') }}" class="ui inverted green button">
                <i class="icon user plus"></i>
                Adicionar
            </a>
            <div class="card">

                <div class="table-responsive-lg">
                    <table class="ui sortable table unstackable celled" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-Mail</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Função</th>
                                <th class="collapsing center aligned no-sort">Editar</th>
                                <th class="collapsing center aligned no-sort">Ativar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($usuarios) < 1) <tr>
                                <td colspan="6">
                                    <h2 class="ui center aligned header">
                                        <i class="info icon"></i>
                                        Nenhum usuário
                                    </h2>
                                </td>
                                </tr>
                                @endif

                                @foreach($usuarios as $usuario)

                                <tr>
                                    <td>{{$usuario->id}}</td>
                                    <td>{{$usuario->name}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td>{{$usuario->cpf}}</td>
                                    <td>{{$usuario->telefone}}</td>
                                    <td>{{$usuario->descricao}}</td>
                                    <td class="selectable center aligned">
                                        <a href="{{route('usuarios.edit', $usuario->id)}}">
                                            <i class="inverted blue edit icon"></i>
                                        </a>
                                    </td>
                                    <form id="formAtivar{{$usuario->id}}" action="{{route('usuarios.destroy', $usuario->id)}}" method="POST">
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
                    @if ($usuarios->lastPage() > 1)
                    <div class="ui pagination menu">
                        <a href="{{ $usuarios->previousPageUrl() }}" class="{{ ($usuarios->currentPage() == 1) ? ' disabled' : '' }} item">
                            Anterior
                        </a>
                        @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
                            <a href="{{ $usuarios->url($i) }}" class="{{ ($usuarios->currentPage() == $i) ? ' active' : '' }} item">
                                {{ $i }}
                            </a>
                            @endfor
                            <a href="{{ $usuarios->nextPageUrl() }}" class="{{ ($usuarios->currentPage() == $usuarios->lastPage()) ? ' disabled' : '' }} item">
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