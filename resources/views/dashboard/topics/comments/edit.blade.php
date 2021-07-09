@extends('adminlte::page')

@section('title', "Editando Tópico: {$topic->title}")

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
                    <a href="{{ route('adm.topics.show', $topic->id) }}">{{ $topic->title }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>Editar</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('adm.topics.show', $topic->id) }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('adm.topics.update', $topic->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @include('dashboard.topics._partials.form')
                @method('PUT')
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Salvar slide</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.includes.button_loading')
@endsection