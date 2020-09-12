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
            <form class="ui form" action="{{ route('usuarios.update', $usuario->id) }}" method="post">
                @csrf
                @method('PATCH')
                <h4 class="ui dividing header">Editar Usuário - {{$usuario->name}}</h4>
                <div class="field required">
                    <label>Nome</label>
                    <input type="text" name="name" value="{{$usuario->name}}" placeholder="Nome do Usuário">
                </div>
                <div class="two fields">
                    <div class="field required">
                        <label>CPF</label>
                        <input class="cpf" name="cpf" value="{{$usuario->cpf}}" placeholder="CPF do Usuário" type="text">
                    </div>
                    <div class="field required">
                        <label>Telefone</label>
                        <input class="telefone" name="telefone" value="{{$usuario->telefone}}" placeholder="Telefone" type="text">
                    </div>
                </div>
                <div class="field required">
                    <label>E-Mail</label>
                    <input type="text" name="email" value="{{$usuario->email}}" placeholder="Endereço de E-Mail">
                </div>
                <div class="two fields">
                    <div class="ten wide field">
                        <label>Senha</label>
                        <input type="password" name="password" placeholder="Digite a senha para o usuário">
                    </div>
                    <div class="seven wide field required">
                        <label>Tipo de Usuário</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" value="{{$usuario->cod_tipo_user}}" name="cod_tipo_usuario">
                            <i class="dropdown icon"></i>
                            <div class="default text">{{$usuario->descricao}}</div>
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
                        <div class="ui slider checkbox @if($usuario->fg_ativo == true) checked @endif">
                            <input type="checkbox" name="fg_ativo" @if($usuario->fg_ativo == true)  checked="checked" @endif tabindex="0" class="hidden">
                            <label>Usuário Ativo</label>
                        </div>
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

    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade');
        });
</script>
@endsection