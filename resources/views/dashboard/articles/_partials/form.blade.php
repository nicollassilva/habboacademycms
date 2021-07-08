@include('habboacademy.utils.alerts')

@csrf

<div class="form-group">
    <label for="title">Título da Notícia</label>
    <input class="form-control" type="text" name="title" placeholder="Título..." value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group">
    <label for="description">Descrição da Notícia</label>
    <input class="form-control" type="text" name="description" placeholder="Descrição..." value="{{ $article->description ?? old('description') }}">
</div>
<div class="form-group">
    <label for="category">Categoria</label>
    <select id="category" class="custom-select" name="category">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="description">Conteúdo da Notícia</label>
    <textarea name="content" id="tiny" class="form-control"></textarea>
</div>