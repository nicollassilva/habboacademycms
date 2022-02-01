<div class="container position-relative">
    <div class="buttons">
        <a class="menu-button" href="{{ route('web.topics.create') }}" data-toggle="tooltip" title="Postar tópico"><i class="pencil"></i></a>
        <a class="menu-button" href="{{ route('web.topics.me') }}" data-toggle="tooltip" title="Meus tópicos"><i class="topics"></i></a>
    </div>
    <div class="user-config">
        <a class="menu-button" href="{{ route('web.users.edit') }}" data-toggle="tooltip" title="Minhas notificações">
            <i class="notifications"></i>
            @php
                $i = false;
            @endphp
            <span @class([
                'badge',
                'bg-danger' => $i,
                'bg-success' => !$i
            ])>{{ $i ? '2' : '0' }}</span>
        </a>
        <div class="picture" style="background-image: url('{{ asset('storage/' . auth()->user()->profile_image_path) }}')">
            <div class="head" style="background-image: url('{{ getAvatar(auth()->user()->username, '&direction=3&head_direction=3&gesture=sml&headonly=1&size=m') }}')"></div>
            <div class="body" style="background-image: url('{{ getAvatar(auth()->user()->username, '&direction=3&head_direction=3&gesture=sml&size=s') }}')"></div>
        </div>
        <a class="menu-button" href="{{ route('web.users.edit') }}" data-toggle="tooltip" title="Configurações da Conta"><i class="config"></i></a>
        <form action="{{ route('web.logout') }}" method="post" class="float-right">
            @csrf
            <button class="menu-button logout" data-toggle="tooltip" title="Sair">
                <strong style="font-size: 12px">Sair</strong>
            </button>
        </form>
    </div>
</div>