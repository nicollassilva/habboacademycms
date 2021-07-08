@extends('adminlte::page')

@section('title', 'Notícia: ' . $category->name)

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
                <li class="breadcrumb-item">
                    <a href="{{ route('articles.categories.index') }}">Categorias</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>{{ $category->name }}</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('articles.categories.index') }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
<a href="{{ route('articles.categories.edit', $category->id) }}" class="btn btn-dark">
    <i class="fas fa-pencil-alt mr-1"></i> Editar
</a>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Informações da Categoria
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Nome:</strong> <br>{{ $category->name }}
            </li>
            <li class="list-group-item">
                <strong>Ícone:</strong> <br>
                <img src="{{ asset("storage/{$category->icon}") }}" class="rounded mb-2 border shadow" alt="{{ $category->name }}"
                    style="max-width: 50px">
            </li>
        </ul>
    </div>
    <div class="card-footer">
        @include('habboacademy.utils.alerts')
        <form action="{{ route('articles.categories.destroy', $category->id) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-1">
                Deletar essa categoria (AÇÃO IRREVERSÍVEL)
            </button>
            <p class="text-muted" style="font-size:12px">
                <strong>OBS:</strong> A categoria só será excluída caso não houver nenhuma notícia que dependa dela. O conteúdo excluído não poderá ser recuperado, somente com backup do banco de dados.
            </p>
        </form>
        <hr>
        <button class="btn btn-dark">Listar notícias relacionadas à essa categoria</button>
    </div>
</div>
@endsection

@section('js')
    @include('dashboard.includes.confirm_delete')
@endsection