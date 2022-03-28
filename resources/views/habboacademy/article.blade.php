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
    <section class="section-news">
        <div class="content-title">
            <div class="icon" style="background-image: url('{{ asset('images/content-icons/news.png') }}')"></div>
            <div class="data">
                <div class="principal">Notícias relacionadas</div>
                <div class="description">Veja outras notícias relacionadas à essa categoria</div>
            </div>
        </div>
        <div class="box-content">
            @foreach ($articles as $article)
                <div class="box-new">
                    <div class="data">
                        <div class="statistics">
                            <i class="fas fa-comment"></i> 0 <i class="fas fa-heart ml-1"></i> 0
                        </div>
                        <div class="statistics" style="width: 60%">
                            <i class="fas fa-clock"></i> {{ dateToString($article->created_at) }}
                        </div>
                    </div>
                    <div class="image" style="background-image: url('{{ \Str::contains($article->image_path, 'articles') ? asset("storage/{$article->image_path}") : $article->image_path }}')"></div>
                    <div class="title" style="height: 35px">
                        <a href="{{ route('web.articles.show', [$article->id, $article->slug]) }}">{{ $article->title }}</a>
                    </div>
                    <div class="footer mt-2">
                        <div class="category text-truncate">{{ $article->category->name }}</div>
                        <div class="author">
                            <div class="avatar" 
                                 style="background-image: url('{{ getAvatar($article->user->username, '&action=wlk&direction=3&head_direction=3&gesture=sml&size=s') }}')"></div>
                                <a href="">{{ $article->user->username }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection