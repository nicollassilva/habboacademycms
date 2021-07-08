@extends('adminlte::page')

@section('title', 'Cadastrar nova Notícia')

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
                    <a>Nova Notícia</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('articles.index') }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('articles.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @include('dashboard.articles._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Enviar notícia</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.includes.tiny_editor')
@endsection