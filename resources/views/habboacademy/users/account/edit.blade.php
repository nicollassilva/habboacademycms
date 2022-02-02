@extends('layouts.app')

@section('title', "Configurações da minha conta")

@section('content')
<div class="container">
    @include('habboacademy.utils.alerts')
    <div class="box-content bg-white box-postar">
        <div class="titulo">
            <span><i class="config mr-2" style="margin-top: 6px"></i> Configurações da Conta</span>
        </div>
        <div class="content p-4" style="min-height: auto; max-height: auto;">
            <form action="{{ route('web.users.update') }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" imageAvatar accept="image/*" class="sr-only" id="avatar" name="avatar">
                <label for="avatar" avatarImage style="background-image: url('{{ asset('storage/' . $user->profile_image_path) }}')"></label>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Digite seu nome" value="" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Nova senha (Só preencha se realmente quiser alterar)">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme sua nova senha (Só preencha se realmente quiser alterar)">
                </div>
                    <div class="form-group">
                        <button type="submit">Salvar novos dados</button>
                    </div>
                </form>
        </div>
    </div>
    <div class="box-content bg-white box-postar">
        <div class="titulo yellow">
            <span><i class="pencil"></i> Configurações do Fórum</span>
        </div>
        <div class="content" style="min-height: auto; max-height: auto;">
            <form action="{{ route('web.users.forumUpdate') }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <textarea name="forumSignature" id="forumSignature" class="form-control">{{ str_replace('<br />', '', auth()->user()->forum_signature) }}</textarea>
                    <div class="bbcode">
                        @include('habboacademy.utils.bbcode', [
                            'element' => '#forumSignature',
                            'type' => 2
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button class="yellow" type="submit">
                        Salvar configurações do Fórum
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection