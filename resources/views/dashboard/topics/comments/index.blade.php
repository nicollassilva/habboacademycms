@extends('adminlte::page')

@section('title', "Comentários do Tópico: {$topic->title}")

@section('content_header')
<div class="card mt-3">
    <div class="card-header">
        <nav aria-label="HabboAcademy BreadCrumb">
            <ol class="breadcrumb text-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.topics.index') }}">Tópicos</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.topics.show', $topic->id) }}">{{ $topic->title }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>Comentários</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<h1 class="mb-2">Comentários</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('adm.topic.comments.search', $topic->id) }}" method="POST" class="form">
            @csrf
            <div class="row">
                <div class="col col-11">
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Pesquise pelo nome do usuário..." class="form-control" value="{{ $filters["filter"] ?? "" }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success py-2 w-100" style="font-size: 13px"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body table-responsive">
        @include('habboacademy.utils.alerts')
        <table class="table table-striped table-hover text-center table-sm">
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>Autor</th>
                    <th>Postado em</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td width="150">
                            <a href="{{ route('adm.topic.comments.show', [$topic->id, $comment->id]) }}" data-toggle="tooltip" title="Visualizar" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('adm.topic.comments.edit', [$topic->id, $comment->id]) }}" data-toggle="tooltip" title="Editar" class="btn btn-sm btn-dark"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                        <td>{{ $comment->user->username }}</td>
                        <td>{{ $comment->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
    @include('dashboard.includes.bootstrap_tooltip')
@endsection