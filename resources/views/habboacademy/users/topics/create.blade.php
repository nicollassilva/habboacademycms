@extends('layouts.app')

@section('content')
<div class="container">
    <div class="box-content bg-white box-postar">
        <div class="titulo">
            <span>Postar um novo tópico</span>
        </div>
        <div class="content">
            @include('habboacademy.utils.alerts')
            <form action="{{ route('topics.store') }}" method="post" class="form">
                @csrf
                <div class="form-group">
                    <input type="text" name="title" placeholder="Digite um título para o tópico" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <div class="categorias"><span>Selecione uma categoria</span>
                        <ul>
                            @foreach ($categories as $category)
                                <li id="{{ $category->id }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="content" id="textTopic" class="form-control">{{ old('content') }}</textarea>
                    <div class="bbcode">
                        @include('habboacademy.utils.bbcode', [
                            'element' => '#textTopic',
                            'type' => 2
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <div class="preview"><i class="noticias"></i> Pré-visualizar tópico</div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="category" value="{{ old('category') }}">
                    <button type="submit">
                        Enviar tópico
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container preview" style="display: none">
    <div class="box-content bg-white box-postar">
        <div class="titulo">
            <div class="icone"><i class="topicos"></i></div><span>Pré-visualização do tópico</span>
        </div>
        <div class="display topico-ler preview-topico shadow-none"></div>
    </div>
</div>
@endsection