@extends('adminlte::page')

@section('title', 'Notícia: ' . $article->title)

@section('content_header')
<div class="card mt-3">
    <div class="card-header">
        <nav aria-label="HabboAcademy BreadCrumb">
            <ol class="breadcrumb text-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('articles.index') }}">Notícias</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>{{ $article->title }}</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('articles.index') }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Informações da Notícia
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Título:</strong> <br>{{ $article->title }}
            </li>
            <li class="list-group-item">
                <strong>Descrição:</strong> <br>{{ $article->description }}
            </li>
            <li class="list-group-item">
                <strong>URL:</strong> <br>{{ $article->slug }}
            </li>
            <li class="list-group-item">
                <strong>Autor:</strong> <br>{{ $article->user->username }}
            </li>
            <li class="list-group-item">
                <strong>Revisada:</strong>
                <i class="fas fa-circle {{ $article->reviewed ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $article->reviewed ? 'Sim, notícia revisada por: ' . $article->reviewer : 'Não foi revisada' }}
            </li>
            <li class="list-group-item">
                <strong>Status:</strong>
                <i class="fas fa-circle {{ $article->status ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $article->status ? 'Notícia ativa' : 'Notícia inativa' }}
            </li>
            <li class="list-group-item">
                <strong>Fixa:</strong>
                <i class="fas fa-circle {{ $article->fixed ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $article->fixed ? 'Notícia fixa' : 'Notícia normal' }}
            </li>
            <li class="list-group-item">
                <strong>Conteúdo:</strong>
                {!! $article->content !!}
            </li>
        </ul>
    </div>
    <div class="card-footer">
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-1">
                Deletar essa notícia (AÇÃO IRREVERSSÍVEL)
            </button>
        </form>
    </div>
</div>
@endsection