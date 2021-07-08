@extends('adminlte::page')

@section('title', 'Slide: ' . $slide->title)

@section('content_header')
<div class="card mt-3">
    <div class="card-header">
        <nav aria-label="HabboAcademy BreadCrumb">
            <ol class="breadcrumb text-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.slides.index') }}">Slides</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>{{ $slide->title }}</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('adm.slides.index') }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
<a href="{{ route('adm.slides.edit', $slide->id) }}" class="btn btn-dark">
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
                <img width="500" src="{{ asset("storage/{$slide->image_path}") }}" class="rounded mb-2 border shadow d-block mx-auto" alt="{{ $slide->title }}">
            </li>
            <li class="list-group-item">
                <strong>Título:</strong> <br>{{ $slide->title }}
            </li>
            <li class="list-group-item">
                <strong>Descrição:</strong> <br>{{ $slide->description }}
            </li>
            <li class="list-group-item">
                <strong>URL:</strong> <br>{{ $slide->slug }}
            </li>
            <li class="list-group-item">
                <strong>Abrir em uma nova aba:</strong> <br>{{ $slide->new_tab ? 'Sim' : 'Não' }}
            </li>
            <li class="list-group-item">
                <strong>Ativo:</strong>
                <i class="fas fa-circle {{ $slide->active ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $slide->active ? 'Esse slide está ativo' : 'Slide inativo' }}
            </li>
            <li class="list-group-item">
                <strong>Fixo:</strong>
                <i class="fas fa-circle {{ $slide->fixed ? 'text-success' : 'text-danger' }}"></i>
                <br>{{ $slide->fixed ? 'Esse slide está fixado' : 'Slide não fixado' }}
            </li>
        </ul>
    </div>
    <div class="card-footer">
        <form action="{{ route('adm.slides.destroy', $slide->id) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-1">
                Deletar esse slide (AÇÃO IRREVERSÍVEL)
            </button>
            <p class="text-muted" style="font-size:12px">O conteúdo excluído não poderá ser recuperado, somente com backup do banco de dados.</p>
        </form>
    </div>
</div>
@endsection

@section('js')
    @include('dashboard.includes.confirm_delete')
@endsection