@include('habboacademy.utils.alerts')

@csrf

<div class="form-group">
    <label for="title">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Título da Notícia:
    </label>
    <input class="form-control" type="text" name="title" placeholder="Título..." value="{{ $article->title ?? old('title') }}">
</div>

<div class="form-group">
    <label for="description">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Descrição da Notícia:
    </label>
    <input class="form-control" type="text" name="description" placeholder="Descrição..." value="{{ $article->description ?? old('description') }}">
</div>

@isset($article)
<div class="form-group">
    <label>
        <i class="fas fa-circle fa-xs text-primary"></i>
        Autor da Notícia:
    </label>
    <input class="form-control" type="text" value="{{ $article->user->username }}" readonly>
</div>
@endisset

<div class="form-group">
    <label for="category">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Categoria:
    </label>
    <select id="category" class="custom-select" name="category">
        @foreach ($categories as $category)
        <option value="{{ $category->id }}"
                @isset($article) {{ $category->id === $article->category_id ? ' selected' : '' }} @endisset>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="image">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Imagem da notícia: @isset($article) <em class="text-muted">(Deixe em branco caso não queira mudar)</em> @endisset
    </label>
    @isset($article)
        <img width="200" src="{{ asset("storage/{$article->image_path}") }}"
            class="rounded mb-2 border shadow d-block" alt="{{ $article->title }}">
    @endisset
    <input id="image" class="form-control-file" type="file" name="image" accept="image/*">
</div>

@isset($article)
<div class="form-group">
    <label for="fixed">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Fixa:
    </label>
    <select id="fixed" class="custom-select" name="fixed">
        <option value="0"{{ $article->fixed === false ? ' selected' : '' }}>Não</option>
        <option value="1"{{ $article->fixed === true ? ' selected' : '' }}>Sim</option>
    </select>
</div>
<div class="form-group">
    <label for="status">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Status:
    </label>
    <select id="status" class="custom-select" name="status">
        <option value="0"{{ $article->status === false ? ' selected' : '' }}>Inativa</option>
        <option value="1"{{ $article->status === true ? ' selected' : '' }}>Ativa</option>
    </select>
</div>
<div class="form-group">
    <label for="reviewed">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Revisada:
    </label>
    <select id="reviewed" class="custom-select" name="reviewed">
        <option value="0"{{ $article->reviewed === false ? ' selected' : '' }}>Não</option>
        <option value="1"{{ $article->reviewed === true ? ' selected' : '' }}>Sim</option>
    </select>
</div>
@endisset

<div class="form-group">
    <label for="description">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Conteúdo da Notícia:
    </label>
    <textarea name="content" id="tiny" class="form-control">{{ $article->content ?? old('content') }}</textarea>
</div>