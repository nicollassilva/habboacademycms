@extends('adminlte::page')

@section('title', 'Notícias')

@section('content_header')
<div class="card mt-3">
    <div class="card-header">
        <nav aria-label="HabboAcademy BreadCrumb">
            <ol class="breadcrumb text-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('articles.index') }}">Notícias</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<h1 class="mb-2">Notícias</h1>
<a href="{{ route('articles.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar</a>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="" method="POST" class="form">
            @csrf
            <div class="row">
                <div class="col col-11">
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Pesquise aqui..." class="form-control" value="{{ $filters["filter"] ?? "" }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success py-2" style="font-size: 13px"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Revisado</th>
                    <th>Revisador</th>
                    <th>Status</th>
                    <th>Fixo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->user->username }}</td>
                        <td>{{ $article->reviewed ? 'Sim' : 'Não' }}</td>
                        <td>{{ $article->reviewer }}</td>
                        <td>{{ $article->status ? 'Sim' : 'Não' }}</td>
                        <td>{{ $article->fixed ? 'Sim' : 'Não' }}</td>
                        <td width="150">
                            <a href="{{ route('article.show', $article->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye mr-1"></i> Ver</a>
                            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt mr-1"></i> Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $articles->appends($filters)->links() !!}
        @else
        {!! $articles->links() !!}
        @endif
    </div>
</div>
@stop