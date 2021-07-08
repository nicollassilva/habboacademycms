@extends('adminlte::page')

@section('title', 'Cadastrar nova Categoria de Notícia')

@section('content_header')
    <h1 class="mb-2">Nova Categoria de Notícia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('articles.categories.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @include('dashboard.articles.categories._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Enviar categoria</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.includes.tiny_editor')
@endsection