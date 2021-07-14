@extends('layouts.app')

@section('title', "Configurações da minha conta")

@section('content')
<div class="container">
    <div class="box-content bg-white box-postar">
        <div class="titulo">
            <span>Configurações da Conta</span>
        </div>
        <div class="content p-4 table-responsive" style="min-height: auto; max-height: auto;">
            <form action="/lib/conta/preferencias" method="post" class="form">
                <input type="file" imageAvatar accept="image/*" class="sr-only" id="avatar" name="avatar">
                <label for="avatar" avatarImage style="background-image: url('{{ asset('storage/' . $user->profile_image_path) }}')"></label>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Digite seu nome" value="" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Nova senha (Só preencha se realmente quiser alterar)">
                </div>
                <div class="form-group">
                    <input type="password" name="confirm-password" class="form-control" placeholder="Confirme sua nova senha (Só preencha se realmente quiser alterar)">
                </div>
                    <div class="form-group">
                        <button type="submit">Salvar novos dados</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection