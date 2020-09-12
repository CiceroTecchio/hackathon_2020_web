@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="ui form">
                <h4 class="ui dividing header">Cadastro de Usuário</h4>
                <div class="field required">
                    <label>Nome</label>
                        <input type="text" name="name" placeholder="Nome do Usuário">
                </div>
                <div class="two fields">
                    <div class="field required">
                        <label>CPF</label>
                        <input class="cpf" name="cpf" placeholder="CPF do Usuário" type="text">
                    </div>
                    <div class="field required">
                        <label>Telefone</label>
                        <input class="telefone" name="telefone" placeholder="Telefone" type="text">
                    </div>
                </div>
                <div class="field required">
                    <label>E-Mail</label>
                        <input type="text" name="email" placeholder="Endereço de E-Mail">
                </div>
                <div class="two fields">
                    <div class="ten wide field required">
                        <label>Senha</label>
                        <input type="password" name="password" placeholder="Digite a senha para o usuário">
                    </div>
                    <div class="seven wide field required">
                        <label>Tipo de Usuário</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="cod_tipo_usuario">
                            <i class="dropdown icon"></i>
                            <div class="default text">Tipo de Usuário</div>
                            <div class="menu">
                                @foreach($tiposUsuario as $tipoUsuario)
                                <div class="item" data-value="{{$tipoUsuario->id}}">{{$tipoUsuario->descricao}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="two fields mt-4">
                    <div class="field">
                        <div class="ui slider checkbox">
                            <input type="checkbox" name="gift" tabindex="0" class="hidden">
                            <label>Usuário Ativo</label>
                        </div>
                    </div>

                </div>

                <button type="submit" class="ui button" tabindex="0">Submit Order</button>
            </form>
        </div>
    </div>
</div>

<script>
    $('.telefone').mask('(00) 0000-00009');
    $('.cpf').mask('000.000.000-00');
    $('.ui.checkbox').checkbox();
    $('.ui.dropdown').dropdown();

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
                },
                password: {
                    identifier: 'password',
                    rules: [{
                            type: 'empty',
                            prompt: 'Por Favor, Digite a Senha.'
                        },
                        {
                            type: 'minLength[6]',
                            prompt: 'Your password must be at least {ruleValue} characters'
                        }
                    ]
                },
                cod_tipo_usuario: {
                    identifier: 'cod_tipo_usuario',
                    rules: [{
                        type: 'empty',
                        prompt: 'Por Favor, Escolha o tipo de usuário'
                    }]
                }
            },
            inline: true,
        });
</script>
@endsection