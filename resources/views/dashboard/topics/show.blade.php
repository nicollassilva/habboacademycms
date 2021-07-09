@extends('adminlte::page')

@section('title', 'Tópico: ' . $topic->title)

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
                <li class="breadcrumb-item active">
                    <a>{{ $topic->title }}</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('adm.topics.index') }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
<a href="{{ route('adm.topics.edit', $topic->id) }}" class="btn btn-dark">
    <i class="fas fa-pencil-alt mr-1"></i> Editar
</a>
<a href="{{ route('adm.topic.comments', $topic->id) }}" class="btn btn-secondary">
    <i class="fas fa-comments mr-1"></i> Comentários desse tópico
</a>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Informações do Tópico
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Título:</strong> <br>{{ $topic->title }}
            </li>
            <li class="list-group-item">
                <strong>Categoria:</strong> <br>{{ $topic->category->name }}
            </li>
            <li class="list-group-item">
                <strong>Autor:</strong> <br>{{ $topic->user->username }}
            </li>
            <li class="list-group-item">
                <strong>URL:</strong> <br>{{ $topic->slug }}
            </li>
            <li class="list-group-item">
                <strong>Moderado:</strong>
                <i class="fas fa-circle {{ $topic->moderated == 'moderated' ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $topic->moderated == 'moderated' ? "Moderado por {$topic->moderator}" : 'Não foi moderado' }}
            </li>
            <li class="list-group-item">
                <strong>Ativo:</strong>
                <i class="fas fa-circle {{ $topic->status ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $topic->status ? 'Esse tópico está ativo' : 'Tópico inativo' }}
            </li>
            <li class="list-group-item">
                <strong>Fixo:</strong>
                <i class="fas fa-circle {{ $topic->fixed ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $topic->fixed ? 'Esse tópico está fixado' : 'Tópico não fixado' }}
            </li>
            <li class="list-group-item">
                <strong>Conteúdo:</strong>
                <hr>
                {!! renderUserCode($topic->content, 2) !!}
            </li>
        </ul>
    </div>
    <div class="card-footer">
        <form action="{{ route('adm.topics.destroy', $topic->id) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-1">
                Deletar esse tópico (AÇÃO IRREVERSÍVEL)
            </button>
            <p class="text-muted" style="font-size:12px">O conteúdo excluído não poderá ser recuperado, somente com backup do banco de dados.</p>
        </form>
    </div>
</div>
@endsection

@section('js')
    @include('dashboard.includes.confirm_delete')
@endsection