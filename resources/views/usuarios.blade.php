@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="ui table unstackable celled" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-Mail</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th class="collapsing center aligned">Editar</th>
                            <th class="collapsing center aligned">Excluir</th>
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
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="ui modal">
    <div class="ui header">
        Editar Instrutor
    </div>
    <div class="content">
        <form id="formEdit" method="post" class="ui form" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="field">
                <label>Nome do Instrutor</label>
                <input id="editNome" type="text" name="nome" placeholder="Nome do Instrutor">

            </div>

            <div class="ui actions">
                <button type="submit" class="ui inverted green button right floated">
                    <i class="checkmark icon"></i>
                    Salvar
                </button>
                <div class="ui deny secondary inverted button right floated" style="margin-bottom: 5%;">
                    <i class="remove icon"></i>
                    Cancelar
                </div>

            </div>
        </form>
    </div>
</div>

<div id="addModal" class="ui small modal">
    <div class="ui header">
        Adicionar Instrutor
    </div>
    <div class="content">
        <form id="formAdd" method="post" class="ui form" enctype="multipart/form-data" action="/instrutores">
            @csrf

            <div class="field">
                <label>Nome do Instrutor</label>
                <input id="addNome" type="text" name="nome" placeholder="Nome do Instrutor">
            </div>

            <div class="ui actions">
                <button type="submit" class="ui inverted green button right floated">
                    <i class="checkmark icon"></i>
                    Salvar
                </button>
                <div class="ui deny secondary inverted button right floated" style="margin-bottom: 5%;">
                    <i class="remove icon"></i>
                    Cancelar
                </div>

            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="ui mini basic modal">
    <div class="ui icon header">
        <i class="trash icon"></i>
        Deletar Instrutor
    </div>
    <div class="content ">
        <p>Deseja realmente deletar o Instrutor <b id="msgDelete" class="header"></b></p>
    </div>
    <div class="actions ">
        <form id="formDelete" method="post">
            @method('delete')
            @csrf
            <div class="ui red basic cancel inverted button">
                <i class="remove icon"></i>
                Não
            </div>
            <button type="submit" class="ui inverted green button">
                <i class="checkmark icon"></i>
                Sim
            </button>
        </form>

    </div>
</div>

@endsection

<script>
    $('.ui.table').DataTable({
        "autoWidth": false,
        // "columnDefs": [{
        //     "targets": [3, 4, 5],
        //     "orderable": false
        // }],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            },
            "buttons": {
                "copy": "Copiar para a área de transferência",
                "copyTitle": "Cópia bem sucedida",
                "copySuccess": {
                    "1": "Uma linha copiada com sucesso",
                    "_": "%d linhas copiadas com sucesso"
                }
            }
        },
        // "scrollY": "50vh",
    });
    $(window).on('resize', function() {
        $('.ui.table').DataTable().columns.adjust();
    });
    $(document).ready(function() {

        function modalDelete() {

            $('#deleteModal').modal('setting', 'closable', false).modal('show');
        }

        function modalEdit() {

            $('#editModal').modal('setting', 'closable', false).modal('show');
        }

        function modalAdd() {
            $('#formAdd').form('reset');
            $('#addModal').modal('setting', 'closable', false).modal('show');
        }
    });
</script>