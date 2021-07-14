@extends('layouts.app')

@section('title', "Meus tópicos do fórum")

@section('content')
<div class="container">
    <div class="box-content bg-white box-postar">
        <div class="titulo">
            <span>Meus tópicos postados</span>
        </div>
        <div class="content p-0 table-responsive" style="min-height: auto; max-height: auto;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Ver</th>
                        <th scope="col">Título</th>
                        <th scope="col">Postado em</th>
                        <th scope="col">Moderado</th>
                        <th scope="col">Comentários</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topics as $topic)
                        <tr>
                            <th scope="row" width="30">
                                <a href="{{ route('web.topics.show', [$topic->id, $topic->slug]) }}" class="btn btn-dark btn-sm">Visualizar</a>
                            </th>
                            <td>{{ mb_strimwidth($topic->title, 0, 50, '...') }}</td>
                            <td>{{ $topic->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                @if ($topic->moderated == 'pending')
                                    <span class="text-secondary"><i class="fas fa-ellipsis-h mr-2"></i>Tópico não moderado</span>
                                @endif

                                @if ($topic->moderated == 'moderated')
                                    <span class="text-primary"><i class="fas fa-check mr-2"></i>Moderado por {{ $topic->moderator }}</span>
                                @endif

                                @if ($topic->moderated == 'closed')
                                    <span class="text-danger"><i class="fas fa-times mr-2"></i>Tópico fechado pela moderação</span>
                                @endif
                            </td>
                            <td width="10"><i class="comentarios mr-2 mt-1"></i>{{ $topic->comments_count }}</td>
                        </tr>
                    @endforeach
                    @if(!$topics->total())
                        <tr>
                            <th colspan="5">
                                <span class="w-100 text-secondary text-center float-left">
                                    <i class="fas fa-battery-empty mr-2"></i>Nenhum tópico encontrado! Crie um novo clicando <a href="{{ route('web.topics.create') }}">aqui</a> e faça novos amigos!
                                </span>
                            </th>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            {!! $topics->links('habboacademy.utils.custom_paginator') !!}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection