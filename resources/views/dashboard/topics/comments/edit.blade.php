@extends('adminlte::page')

@section('title', "Editando comentário: {$comment->id}")

@section('content_header')
<div class="card mt-3">
    <div class="card-header">
        <nav aria-label="HabboAcademy BreadCrumb">
            <ol class="breadcrumb text-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.topics.index') }}">Tópico</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.topics.show', $comment->topic->id) }}">{{ $comment->topic->title }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.topic.comments', $comment->topic->id) }}">Comentários</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.topic.comment.show', [$comment->topic->id, $comment->id]) }}">{{ $comment->id }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>Editar</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('adm.topic.comment.show', [$comment->topic->id, $comment->id]) }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('adm.topic.comment.update', [$comment->topic->id, $comment->id]) }}" class="form" method="POST" enctype="multipart/form-data">
                @include('dashboard.topics.comments._partials.form')
                @method('PUT')
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Salvar comentário</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.includes.button_loading')
@endsection