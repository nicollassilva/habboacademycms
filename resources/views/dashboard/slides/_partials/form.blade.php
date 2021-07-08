@include('habboacademy.utils.alerts')

@csrf

<div class="form-group">
    <label for="title">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Título do Slide:
    </label>
    <input class="form-control" type="text" name="title" placeholder="Título..." value="{{ $slide->title ?? old('title') }}">
</div>

<div class="form-group">
    <label for="description">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Descrição do Slide:
    </label>
    <input class="form-control" type="text" name="description" placeholder="Descrição..." value="{{ $slide->description ?? old('description') }}">
</div>

<div class="form-group">
    <label for="slug">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Url do Slide:
    </label>
    <input class="form-control" type="text" name="slug" placeholder="Descrição..." value="{{ $slide->slug ?? old('slug') }}">
</div>

<div class="form-group">
    <label for="image">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Imagem do slide: @isset($slide) <em class="text-muted">(Deixe em branco caso não queira mudar)</em> @endisset
    </label>
    @isset($slide)
        <img width="200" src="{{ asset("storage/{$slide->image_path}") }}"
            class="rounded mb-2 border shadow d-block" alt="{{ $slide->title }}">
    @endisset
    <input id="image" class="form-control-file" type="file" name="image" accept="image/*">
</div>

<div class="form-group">
    <label for="new_tab">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Abrir em uma nova guia:
    </label>
    <select id="new_tab" class="custom-select" name="new_tab">
        <option value="0" @isset($slide) {{ $slide->new_tab === false ? ' selected' : '' }} @endisset>Não</option>
        <option value="1" @isset($slide) {{ $slide->new_tab === true ? ' selected' : '' }} @endisset>Sim</option>
    </select>
</div>

@isset($slide)
<div class="form-group">
    <label for="active">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Ativo:
    </label>
    <select id="active" class="custom-select" name="active">
        <option value="0"{{ $slide->active === false ? ' selected' : '' }}>Não</option>
        <option value="1"{{ $slide->active === true ? ' selected' : '' }}>Sim</option>
    </select>
</div>
<div class="form-group">
    <label for="fixed">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Fixa:
    </label>
    <select id="fixed" class="custom-select" name="fixed">
        <option value="0"{{ $slide->fixed === false ? ' selected' : '' }}>Não</option>
        <option value="1"{{ $slide->fixed === true ? ' selected' : '' }}>Sim</option>
    </select>
</div>
@endisset