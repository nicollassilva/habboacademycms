@extends('layouts.app')

@php
    $tarja = getTarja(0);
@endphp

@section('content')
<div class="topic-owner">
    <div class="container">
        <div class="box-owner">
            <div class="user-image">
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
            <div class="estatistica" data-toggle="tooltip" title="Comentários"><i class="comentarios mr-1"></i><b class="ml-1">4</b></div>
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
        {{ renderUserCode($topic->content, 2); }}
        <div class="assinatura">
            <span class="titleAss">
                <i class="noticias"></i> Assinatura de <b class="ml-1"><?php echo $topic->user->username ?></b>
            </span>
            Assinatura do usuário
        </div>
    </div>
</div>
@endsection