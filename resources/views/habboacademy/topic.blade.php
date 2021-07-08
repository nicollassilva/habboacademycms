@extends('layouts.app')

@php
    $tarja = getTarja($topic->user->topics_comment_count);
@endphp

@section('content')
<div class="topic-owner" style="margin-top: -20px">
    <div class="container">
        <div class="box-owner">
            <div class="user-image" style="background-image: url('{{ asset('storage/' . $topic->user->profile_image_path) }}')">
                @if ($topic->fixed)
                <div class="fixed-topic"><i class="fixo mr-1"></i>Tópico fixado</div>
                @endif
                <div class="tarja" style="background-image: url('{{ asset('/images/tarjas/' . $tarja["level"]) }}.png')"></div>
                <div class="stage-user"></div>
                <a href="/home/{{ $topic->user->username }}">
                    <div class="avatar normal" style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?&user={{ $topic->user->username }}&headonly=0&direction=2&head_direction=3&action=wav&gesture=sit&size=m')"></div>
                </a>
            </div>
            <div class="nome-topico">
                <i class="forums"></i> <span class="text-truncate" data-toggle="tooltip" title="{{ $topic->title }}">{{ $topic->title }}</span>
            </div>
            <div class="emblemas-owner">
                <!--div class="paginacao">
                    <button><i class="fas fa-angle-left"></i></button>
                    <button><i class="fas fa-angle-right"></i></button>
                </div-->
                <span><i class="emblemas"></i>Últimos emblemas de <a href="/home/{{ $topic->user->username }}" class="text-white"><b class="ml-1">{{ $topic->user->username }}</b></a></span>
                <div class="box-emblemas">
                    {{-- <div class="emblema" style="background-image: url('uploads/adminUploads/')" data-placement="bottom" data-toggle="tooltip" title="<b class='mr-1'>Código:</b><br>"></div> --}}
                </div>
            </div>
        </div>
        <div class="estatisticas">
            <div class="estatistica" data-toggle="tooltip" title="Gostei"><i class="curtida mr-1"></i><b class="ml-1">2</b></div>
            <div class="estatistica" data-toggle="tooltip" title="Não gostei"><i class="descurtida mr-1"></i><b class="ml-1">3</b></div>
            <div class="estatistica" data-toggle="tooltip" title="Comentários"><i class="comentarios mr-1"></i><b class="ml-1">{{ $topic->comments_count }}</b></div>
            <div class="estatistica"><i class="calendario mr-1"></i>{{ dateToString($topic->created_at) }}</div>
            <div class="estatistica"><i class="noticias mr-1"></i>Categoria:<b class="ml-1">{{ $topic->category->name }}</b></div>
            @if ($topic->moderated == 'moderated')
            <div class="estatistica"><i class="moderado mr-1"></i>Moderado por <b class="ml-1">{{ $topic->moderator }}</b></div>
            @endif
            @if ($topic->moderated == 'pending')
            <div class="estatistica bg-danger text-white border-white"><i class="moderado mr-1"></i>Tópico não moderado</div>
            @else
            <div class="estatistica bg-dark text-white"><i class="moderado mr-1"></i>Tópico fechado pela moderação.</div> 
            @endif
            <div class="estatistica" data-toggle="tooltip" title="Descer"><i class="descer"></i></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="display topico-ler">
        {!! renderUserCode($topic->content, 2); !!}
        <div class="assinatura">
            <span class="titleAss">
                <i class="noticias"></i> Assinatura de <b class="ml-1"><?php echo $topic->user->username ?></b>
            </span>
            Assinatura do usuário
        </div>
    </div>
</div>
@if (!Auth::check())
<div class="area-comentar">
    <span>É necessário se cadastrar ou fazer login para comentar isso!</span>
    <div class="frank">
        <a href="{{ route('web.register') }}">
            <button>Cadastre-se</button>
        </a>
        <i class="frank-comentarios"></i>
        <a href="{{ route('web.login') }}">
            <button>Faça login</button>
        </a>
    </div>
</div>
@else
<div class="comentar-neg mt-5 mb-5">
    <div class="container">
    @include('habboacademy.utils.alerts')
    @if ($topic->moderated != 'closed')
        <h4 class="h4 font-weight-bold my-4 float-left w-100"><i class="forums mr-2"></i><span class="mt-1 float-left ml-2">Faça seu comentário</span></h4>
        <form action="{{ route('web.topics.comments.store', [$topic->id, $topic->slug]) }}" method="post" class="form">
            @csrf
            <textarea name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
                <div class="bbcode">
                    @include('habboacademy.utils.bbcode', [
                        'element' => '#content',
                        'type' => 2
                    ])
                    <div class="btn">
                        <button type="submit">Enviar</button>
                    </div>
                </div>
            <button type="button" class="prevComment">Prévia do comentário</button>
        </form>
        <div class="display topico-comentarios" style="display: none !important"></div>
    @else
        <h5 class="w-100 m-0 float-left text-center text-danger">
            Esse tópico foi fechado pela moderação e não pode mais ser comentado.
        </h5>
    @endif
    </div>
</div>
@endif
<div class="container">
    <h4 class="h4 font-weight-bold font-italic my-4 float-left w-100">Comentários deste tópico</h4>
    <div class="display topico-comentarios">
        @foreach ($comments as $comment)
        <div class="comentario">
            <div class="titulo bg-primary">
                <div class="user">
                    <div class="cabeca" style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?&user={{ $comment->user->username }}&headonly=1&direction=2&head_direction=3&action=&gesture=&size=m')"></div>
                </div>
                <div class="topico text-truncate">RE: {{ $topic->title }}</div>
                <div class="acoes">
                    {{-- <div class="reacao <?php echo $autorReaction['reacao'] ?>" data-toggle="tooltip" title="<?php echo $comment['autor'] .' '. $autorReaction['reacao'] ?> esse tópico"><i class="<?php echo $autorReaction['reacao'] == 'curtiu' ? 'curtida' : 'descurtida' ?>"></i></div> --}}
                    <button class="reportar" data-toggle="tooltip" title="Reportar comentário"><i class="alerta"></i></button>
                    <div class="data"><i class="relogio mr-2"></i>{{ dateToString($comment->created_at) }}</div>
                </div>
            </div>
            <div class="area-user">
                <div class="foto" style="background-image: url('{{ asset('storage/' . $comment->user->profile_image_path) }}')">
                    <div class="stage-user"></div>
                    <div class="user bg-primary"><span class="text-truncate"><a href="/home/{{ $comment->user->username }}" class="text-white" style="text-decoration: none !important">{{ $comment->user->username }}</a></span></div>
                    <div class="avatar normal" style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?&user={{ $comment->user->username }}&headonly=0&direction=2&head_direction=3&action=wav&gesture=sit&size=m')"></div>
                </div>
                <div class="box-tarja">
                    <div class="restantes" data-toggle="tooltip" data-placement="bottom" title="15 comentários no fórum">
                        @php
                            $totalComments = $comment->user->topics_comment_count;

                            $tarja = getTarja($totalComments);

                            $final = $totalComments / $tarja["next"] * 100;
                        @endphp
                        <span style="width: {{ $final }}%" data-toggle="tooltip" title="Faltam {{ $tarja["next"] - $totalComments }} comentários para o próximo nível">{{ $final }}%</span>
                    </div>
                    <div class="tarja" style="background-image: url('{{ asset('/images/tarjas/' . $tarja["level"]) }}.png')"></div>
                </div>
            </div>
            <div class="conteudo">
                {!! renderUserCode($comment->content, 2) !!}
                <div class="assinatura">
                    <span class="titleAss">
                        <i class="noticias"></i> Assinatura de <b class="ml-1">{{ $comment->user->username }}</b>
                    </span>
                    Assinatura do usuário do comentário
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {!! $comments->links('habboacademy.utils.custom_paginator') !!}
</div>

@endsection