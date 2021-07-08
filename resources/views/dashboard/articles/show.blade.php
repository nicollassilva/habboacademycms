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
<a href="{{ route('articles.edit', $article->id) }}" class="btn btn-dark">
    <i class="fas fa-pencil-alt mr-1"></i> Editar
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
                <img width="500" src="{{ asset("storage/{$article->image_path}") }}" class="rounded mb-2 border shadow d-block mx-auto" alt="{{ $article->title }}">
            </li>
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
                <hr>
                {!! $article->content !!}
            </li>
        </ul>
    </div>
    <div class="card-footer">
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-1">
                Deletar essa notícia (AÇÃO IRREVERSÍVEL)
            </button>
            <p class="text-muted" style="font-size:12px">O conteúdo excluído não poderá ser recuperado, somente com backup do banco de dados.</p>
        </form>
    </div>
</div>
@endsection

@section('js')
    @include('dashboard.includes.confirm_delete')
@endsection