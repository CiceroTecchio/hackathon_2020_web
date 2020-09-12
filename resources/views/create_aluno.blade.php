@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
            <div class="ui positive message">
                <i class="close icon"></i>
                <div class="header">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            <form class="ui form" action="{{ route('alunos.store') }}" method="post">
                @csrf
                <h4 class="ui dividing header">Cadastro de Aluno</h4>
                <div class="field required">
                    <label>Nome</label>
                    <input type="text" name="nome" placeholder="Nome do Aluno">
                </div>
                <div class="two fields">
                    <div class="field required">
                        <label>CPF</label>
                        <input class="cpf" name="cpf" placeholder="CPF do Aluno" type="text">
                    </div>
                    <div class="field required">
                        <label>Telefone</label>
                        <input class="telefone" name="telefone" placeholder="Telefone" type="text">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field required">
                        <label>E-Mail</label>
                        <input type="text" name="email" placeholder="Endereço de E-Mail">
                    </div>
                    <div class="field required">
                        <label>RA</label>
                        <input type="text" name="ra" placeholder="RA">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field mt-4">
                        <div class="ui slider checkbox">
                            <input type="checkbox" name="fg_ativo" tabindex="0" class="hidden">
                            <label>Aluno Ativo</label>
                        </div>
                    </div>
                    <div class="field">
                        <label>Turma</label>
                        <select id="turma" name="cod_turma" class="ui search dropdown">
                        </select>
                    </div>

                </div>

                <button type="submit" class="ui inverted green button" tabindex="0">Salvar</button>
            </form>
        </div>
    </div>
</div>

<script>
    $('.telefone').mask('(00) 0000-00009');
    $('.cpf').mask('000.000.000-00');
    $('.ui.checkbox').checkbox();

    $('#turma').dropdown({
        placeholder: 'Selecione uma turma',
        apiSettings: {
            minCharacters: 0,
            cache: false,
            url: '/busca/turmas?query={query}',
            beforeSend: function(settings) {
                $('#turma').dropdown('setup menu', {
                    values: null
                });
                return settings;
            }
        },
        ignoreCase: true,
        message: {
            noResults: 'Nenhum resultado encontrado.'
        }
    });


    $('.ui.form')
        .form({
            fields: {
                name: {
                    identifier: 'name',
                    rules: [{
                        type: 'empty',
                        prompt: 'Por Favor, Digite o nome.'
                    }]
                },
                cpf: {
                    identifier: 'cpf',
                    rules: [{
                        type: 'exactLength[14]',
                        prompt: 'Por Favor, Digite o CPF.'
                    }]
                },
                telefone: {
                    identifier: 'telefone',
                    rules: [{
                        type: 'minLength[14]',
                        prompt: 'Por Favor, Digite o telefone.'
                    }]
                },
                email: {
                    identifier: 'email',
                    rules: [{
                        type: 'email',
                        prompt: 'Por Favor, Digite o E-Mail.'
                    }]
                }
            },
            inline: true,
        });

    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade');
        });
</script>
@endsection