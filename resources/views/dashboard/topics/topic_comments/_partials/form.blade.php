@include('habboacademy.utils.alerts')

@csrf

<div class="row d-flex">
    <div class="col">
        <div class="form-group">
            <label>
                <i class="fas fa-circle fa-xs text-primary"></i>
                Título do Tópico:
            </label>
            <input class="form-control" type="text" value="{{ $comment->topic->title }}" readonly>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>
                <i class="fas fa-circle fa-xs text-primary"></i>
                Autor do Tópico:
            </label>
            <input class="form-control" type="text" value="{{ $comment->topic->user->username }}" readonly>
        </div>
    </div>
</div>

<hr>
<div class="row d-flex">
    <div class="col">
        <div class="form-group">
            <label>
                <i class="fas fa-circle fa-xs text-primary"></i>
                ID do Comentário:
            </label>
            <input class="form-control" type="number" value="{{ $comment->id }}" readonly>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>
                <i class="fas fa-circle fa-xs text-primary"></i>
                Autor do Comentário:
            </label>
            <input class="form-control" type="text" value="{{ $comment->user->username }}" readonly>
        </div>        
    </div>
</div>

<hr>
@isset($comment)
<div class="form-group">
    <label for="active">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Ativo:
    </label>
    <select id="active" class="custom-select" name="active">
        <option value="0"{{ $comment->active === false ? ' selected' : '' }}>Comentário oculto</option>
        <option value="1"{{ $comment->active === true ? ' selected' : '' }}>Comentário ativo</option>
    </select>
</div>
<div class="form-group">
    <label for="moderated">
        <i class="fas fa-circle fa-xs text-primary"></i>
        Moderado:
    </label>
    <select id="moderated" class="custom-select" name="moderated">
        <option value="moderated"{{ $comment->moderated == 'moderated' ? ' selected' : '' }}>Moderado</option>
        <option value="pending"{{ $comment->moderated == 'pending' ? ' selected' : '' }}>Pendente</option>
    </select>
</div>
@endisset