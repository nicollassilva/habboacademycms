@extends('adminlte::page')

@section('title', 'Tópicos')

@section('content_header')
<div class="card mt-3">
    <div class="card-header">
        <nav aria-label="HabboAcademy BreadCrumb">
            <ol class="breadcrumb text-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('adm.dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>Tópicos</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<h1 class="mb-2">Tópicos</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('adm.topics.search') }}" method="POST" class="form">
            @csrf
            <div class="row">
                <div class="col col-11">
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Pesquise pelo título..." class="form-control" value="{{ $filters["filter"] ?? "" }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success py-2 w-100" style="font-size: 13px"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body table-responsive">
        @include('habboacademy.utils.alerts')
        <table class="table table-striped table-hover text-center table-sm">
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Moderado</th>
                    <th>Status</th>
                    <th>Fixo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topics as $topic)
                    <tr>
                        <td width="150">
                            <a href="{{ route('adm.topics.show', $topic->id) }}" data-toggle="tooltip" title="Visualizar" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('adm.topics.edit', $topic->id) }}" data-toggle="tooltip" title="Editar" class="btn btn-sm btn-dark"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{ route('adm.topic.comments', $topic->id) }}" data-toggle="tooltip" title="Comentários" class="btn btn-sm btn-dark"><i class="fas fa-comments"></i></a>
                        </td>
                        <td>{{ $topic->title }}</td>
                        <td>{{ $topic->user->username }}</td>
                        <td>
                            @if ($topic->moderated == 'moderated')
                                <span class="text-success">Moderado por: <em>{{ $topic->moderator }}</em></span>
                            @endif

                            @if ($topic->moderated == 'pending')
                                <span class="text-secondary">Não moderado</span>
                            @endif

                            @if ($topic->moderated == 'closed')
                                <span class="text-danger">Tópico fechado</span>
                            @endif
                        </td>
                        <td>
                            <i class="fas fa-circle fa-xs ml-2 {{ $topic->status ? 'text-success' : 'text-danger' }}"></i>
                        </td>
                        <td>
                            <i class="fas fa-circle fa-xs ml-2 {{ $topic->fixed ? 'text-success' : 'text-danger' }}"></i>
                        </td>
                    </tr>
                @endforeach
            </temody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $topics->appends($filters)->links() !!}
        @else
        {!! $topics->links() !!}
        @endif
    </div>
</div>
@stop

@section('js')
    @include('dashboard.includes.bootstrap_tooltip')
@endsection