@extends('adminlte::page')

@section('title', 'Comentário do tópico: ' . $comment->topic->title)

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
                    <a href="{{ route('adm.topics.show', $comment->topic->id) }}">{{ $comment->topic->title }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.topic.comments', $comment->topic->id) }}">Comentários</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>Comentário ID {{ $comment->id }}</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('adm.topic.comments', $comment->topic->id) }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
<a href="{{ route('adm.topic.comment.edit', [$comment->topic->id, $comment->id]) }}" class="btn btn-dark">
    <i class="fas fa-pencil-alt mr-1"></i> Editar
</a>

<!-- 
    Todo: Continuar com a edição dos comentários de tópicos, inserir as novas tabelas no model e fazer o CRUD
-->
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Informações do comentário
    </div>
    <div class="card-body">
        @include('habboacademy.utils.alerts')
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Autor:</strong> <br>{{ $comment->user->username }}
            </li>
            <li class="list-group-item">
                <strong>Comentado em:</strong> <br>{{ $comment->created_at->format('d-m-Y H:i') }}
            </li>
            <li class="list-group-item">
                <strong>Moderado:</strong>
                <i class="fas fa-circle {{ $comment->moderated == 'moderated' ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $comment->moderated == 'moderated' ? "Moderado por: {$comment->moderator}" : 'Não foi moderado' }}
            </li>
            <li class="list-group-item">
                <strong>Ativo:</strong>
                <i class="fas fa-circle {{ $comment->active ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $comment->active ? 'Esse comentário está ativo' : 'Comentário oculto' }}
            </li>
            <li class="list-group-item">
                <strong>Conteúdo:</strong>
                <hr>
                <br>{!! renderUserCode($comment->content, 2) !!}
            </li>
        </ul>
    </div>
</div>
@endsection

@section('js')
    @include('dashboard.includes.confirm_delete')
@endsection