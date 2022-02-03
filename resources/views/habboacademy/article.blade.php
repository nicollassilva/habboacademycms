@extends('layouts.app')

@section('title', "Notícia: {$article->title}")

@section('content')
<div class="capa" style="background-image: url('{{ \Str::contains($article->image_path, 'articles') ? asset("storage/{$article->image_path}") : $article->image_path }}')">
    <div class="obscure"></div>
    <h2 class="title text-center">{{ $article->title }}</h2>
    <span><i class="relogio mr-1 mt-1"></i>Notícia postada {{ dateToString($article->created_at) }}</span>
</div>
<div class="row m-0">
    <div class="container article">
        <div class="dados">
            <button>
                <i class="curtida"></i>
                <span>0</span>
            </button>
            <button>
                <i class="descurtida"></i>
                <span>0</span>
            </button>
            <button>
                <i class="amor"></i>
                <span>0</span>
            </button>
            <div class="button"><i class="comentarios mr-1"></i> <b class="mr-1">0</b> comentários</div>
            <div class="button"><i class="noticias mr-1"></i> <b class="mr-1">Categoria:</b>{{ $article->category->name }}</div>
            <div class="button">
                <div class="avatar normal" 
                    style="background-image: url('{{ getAvatar($article->user->username, '&action=std&direction=2&head_direction=2&img_format=png&gesture=std&frame=1&headonly=0&size=m') }}')"></div>
                Postado por 
                <b class="ml-1">
                    <a class="text-dark" href="">
                        {{ $article->user->username }}
                    </a>
                </b>
            </div>
        </div>
        <div class="display noticia-ler rounded-sm">
            {!! $article->content !!}
        </div>
    </div>
</div>
<div class="container my-3">
    @include('habboacademy.layouts.articles', ['asWidget' => true])
</div>
@endsection