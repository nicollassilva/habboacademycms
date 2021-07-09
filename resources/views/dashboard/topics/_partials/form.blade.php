@include('habboacademy.utils.alerts')

@csrf

<div class="form-group">
    <label for="title">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Título do Tópico:
    </label>
    <input class="form-control" type="text" name="title" placeholder="Título..." value="{{ $topic->title ?? old('title') }}">
</div>

<div class="form-group">
    <label>
        <i class="fas fa-circle fa-xs text-primary"></i>
        Autor do Tópico:
    </label>
    <input class="form-control" type="text" value="{{ $topic->user->username }}" readonly>
</div>

<div class="form-group">
    <label for="category">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Categoria:
    </label>
    <select id="category" class="custom-select" name="category">
        @foreach ($categories as $category)
        <option value="{{ $category->id }}"
                @isset($topic) {{ $category->id === $topic->category_id ? ' selected' : '' }} @endisset>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
</div>

@isset($topic)
<div class="form-group">
    <label for="status">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Ativo:
    </label>
    <select id="status" class="custom-select" name="status">
        <option value="0"{{ $topic->status === false ? ' selected' : '' }}>Não</option>
        <option value="1"{{ $topic->status === true ? ' selected' : '' }}>Sim</option>
    </select>
</div>
<div class="form-group">
    <label for="fixed">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Fixo:
    </label>
    <select id="fixed" class="custom-select" name="fixed">
        <option value="0"{{ $topic->fixed === false ? ' selected' : '' }}>Não</option>
        <option value="1"{{ $topic->fixed === true ? ' selected' : '' }}>Sim</option>
    </select>
</div>
<div class="form-group">
    <label for="moderated">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Moderado:
    </label>
    <select id="moderated" class="custom-select" name="moderated">
        <option value="moderated"{{ $topic->moderated == 'moderated' ? ' selected' : '' }}>Moderado</option>
        <option value="pending"{{ $topic->moderated == 'pending' ? ' selected' : '' }}>Pendente</option>
        <option value="closed"{{ $topic->moderated == 'closed' ? ' selected' : '' }}>Fechado</option>
    </select>
</div>
@endisset