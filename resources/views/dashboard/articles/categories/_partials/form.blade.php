@include('habboacademy.utils.alerts')

@csrf

<div class="form-group">
    <label for="name">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Nome da Categoria:
    </label>
    <input class="form-control" type="text" name="name" placeholder="Título..." value="{{ $category->name ?? old('name') }}">
</div>

<div class="form-group">
    <label for="icon">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Ícone da categoria: @isset($category) <em class="text-muted">(Deixe em branco caso não queira mudar)</em> @endisset
    </label>
    @isset($category)
        <img src="{{ asset("storage/{$category->icon}") }}"
            class="rounded mb-2 border shadow d-block" alt="{{ $category->name }}" style="max-width: 50px">
    @endisset
    <input id="icon" class="form-control-file" type="file" name="icon" accept="image/*">
</div>