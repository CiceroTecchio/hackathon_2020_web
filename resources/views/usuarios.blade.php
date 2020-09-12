@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="ui center aligned header">
                <i class="users icon"></i>
                Lista de Usuários
            </h2>
            <a href="{{ route('usuarios.create') }}" class="ui inverted green button">
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
                                <th class="collapsing center aligned no-sort">Editar</th>
                                <th class="collapsing center aligned no-sort">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)

                            <tr>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->cpf}}</td>
                                <td>{{$usuario->telefone}}</td>
                                <td class="selectable center aligned">
                                    <a href="#" onclick="modalEdit()">
                                        <i class="inverted blue edit icon"></i>
                                    </a>
                                </td>
                                <td class="selectable center aligned">

                                    <a href="#" onclick="modalDelete()">
                                        <i class="inverted red trash icon"></i>
                                    </a>
                                </td>
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
</script>
@endsection