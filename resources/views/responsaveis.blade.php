@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="ui center aligned header">
                <i class="users icon"></i>
                Lista de responsaveis
            </h2>
            @if (session('success'))
            <div class="ui positive message">
                <i class="close icon"></i>
                <div class="header">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            <a href="{{ route('responsavel.create') }}" class="ui inverted green button">
                <i class="icon user plus"></i>
                Adicionar
            </a>
            <div class="card">

                <div class="table-responsive-lg">
                    <table class="ui sortable table unstackable celled" width="100%">
                        <thead>
                            <tr>
                                <th>Responsável</th>
                                <th>Aluno</th>
                                <th class="collapsing center aligned no-sort">Editar</th>
                                <th class="collapsing center aligned no-sort">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($responsaveis) < 1) <tr>
                                <td colspan="6">
                                    <h2 class="ui center aligned header mt-2">
                                        <i class="info icon"></i>
                                        Nenhum usuário
                                    </h2>
                                </td>
                                </tr>
                                @endif

                                @foreach($responsaveis as $responsavel)

                                <tr>
                                    <td>{{$responsavel->responsavel}}</td>
                                    <td>{{$responsavel->aluno}}</td>
                                    <td class="selectable center aligned">
                                        <a href="{{route('responsavel.edit', $responsavel->id)}}">
                                            <i class="inverted blue edit icon"></i>
                                        </a>
                                    </td>
                                    <form id="formAtivar{{$responsavel->id}}" action="{{route('responsavel.destroy', $responsavel->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <td class="selectable center aligned">
                                            <a href="#" onclick="document.getElementById('formAtivar{{$responsavel->id}}').submit(); return false;">
                                                <i class="inverted red trash icon"></i>
                                            </a>
                                        </td>
                                    </form>

                                </tr>

                                @endforeach

                        </tbody>

                    </table>
                    @if ($responsaveis->lastPage() > 1)
                    <div class="ui pagination menu">
                        <a href="{{ $responsaveis->previousPageUrl() }}" class="{{ ($responsaveis->currentPage() == 1) ? ' disabled' : '' }} item">
                            Anterior
                        </a>
                        @for ($i = 1; $i <= $responsaveis->lastPage(); $i++)
                            <a href="{{ $responsaveis->url($i) }}" class="{{ ($responsaveis->currentPage() == $i) ? ' active' : '' }} item">
                                {{ $i }}
                            </a>
                            @endfor
                            <a href="{{ $responsaveis->nextPageUrl() }}" class="{{ ($responsaveis->currentPage() == $responsaveis->lastPage()) ? ' disabled' : '' }} item">
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