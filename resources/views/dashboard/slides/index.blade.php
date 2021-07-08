@extends('adminlte::page')

@section('title', 'Slides')

@section('content_header')
<div class="card mt-3">
    <div class="card-header">
        <nav aria-label="HabboAcademy BreadCrumb">
            <ol class="breadcrumb text-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a>Slides</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<h1 class="mb-2">Slides</h1>
<a href="{{ route('slides.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar</a>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="" method="POST" class="form">
            @csrf
            <div class="row">
                <div class="col col-11">
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Pesquise aqui..." class="form-control" value="{{ $filters["filter"] ?? "" }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success py-2" style="font-size: 13px"><i class="fas fa-search"></i></button>
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
                    <th>Descrição</th>
                    <th>Ativo</th>
                    <th>Fixo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slides as $slide)
                    <tr>
                        <td width="150">
                            <a href="{{ route('slides.show', $slide->id) }}" data-toggle="tooltip" title="Visualizar" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('slides.edit', $slide->id) }}" data-toggle="tooltip" title="Editar" class="btn btn-sm btn-dark"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                        <td>{{ $slide->title }}</td>
                        <td>{{ $slide->description }}</td>
                        <td>{{ $slide->active ? 'Ativo' : 'Inativo' }}</td>
                        <td>{{ $slide->fixed ? 'Sim' : 'Não' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $slides->appends($filters)->links() !!}
        @else
        {!! $slides->links() !!}
        @endif
    </div>
</div>
@stop