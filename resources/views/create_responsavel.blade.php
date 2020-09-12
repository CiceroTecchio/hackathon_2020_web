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
            <form class="ui form" action="{{ route('responsavel.store') }}" method="post">
                @csrf
                <h4 class="ui dividing header">Cadastro de Responsável</h4>
                    <div class="field">
                    <label>Responsável</label>
                        <select id="responsavel" name="cod_responsavel" class="ui search dropdown">
                        </select>
                    </div>
                    <div class="field">
                        <label>aluno</label>
                        <select id="aluno" name="cod_aluno" class="ui search dropdown">
                        </select>
                    </div>


                <button type="submit" class="ui inverted green button" tabindex="0">Salvar</button>
            </form>
        </div>
    </div>
</div>

<script>
    $('#responsavel').dropdown({
        placeholder: 'Selecione um responsavel',
        apiSettings: {
            minCharacters: 0,
            cache: false,
            url: '/busca/responsavel?query={query}',
            beforeSend: function(settings) {
                $('#responsavel').dropdown('setup menu', {
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

    $('#aluno').dropdown({
        placeholder: 'Selecione um aluno',
        apiSettings: {
            minCharacters: 0,
            cache: false,
            url: '/busca/alunos?query={query}',
            beforeSend: function(settings) {
                $('#aluno').dropdown('setup menu', {
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
                aluno: {
                    identifier: 'aluno',
                    rules: [{
                        type: 'empty',
                        prompt: 'Por Favor, selecione o aluno.'
                    }]
                },
                responsavel: {
                    identifier: 'responsavel',
                    rules: [{
                        type: 'empty',
                        prompt: 'Por Favor, selecione o responsável.'
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