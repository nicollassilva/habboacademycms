@extends('adminlte::page')

@section('title', 'Cadastrar novo Slide')

@section('content_header')
<div class="card mt-3">
    <div class="card-header">
        <nav aria-label="HabboAcademy BreadCrumb">
            <ol class="breadcrumb text-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('slides.index') }}">Slides</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>Novo Slide</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<a href="{{ route('slides.index') }}" class="btn btn-danger">
    <i class="fas fa-chevron-left mr-1"></i> Voltar
</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('slides.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @include('dashboard.slides._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Enviar slide</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.includes.button_loading')
@endsection