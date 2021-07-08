@extends('adminlte::page')

@section('title', 'Editar Notícia')

@section('content_header')
    <h1 class="mb-2">Editar Notícia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('articles.update', $article->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @include('dashboard.articles._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Salvar notícia</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.includes.scripts')
@endsection