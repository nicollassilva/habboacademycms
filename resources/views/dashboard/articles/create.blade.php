@extends('adminlte::page')

@section('title', 'Cadastrar nova Notícia')

@section('content_header')
    <h1 class="mb-2">Nova Notícia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('articles.store') }}" class="form" method="POST">
                @include('dashboard.articles._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Enviar notícia</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.includes.scripts')
@endsection