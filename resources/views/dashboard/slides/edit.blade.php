@extends('adminlte::page')

@section('title', "Editando Notícia: {$slide->title}")

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
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.slides.show', $slide->id) }}">{{ $slide->title }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>Editar</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('adm.slides.show', $slide->id) }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('adm.slides.update', $slide->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @include('dashboard.slides._partials.form')
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