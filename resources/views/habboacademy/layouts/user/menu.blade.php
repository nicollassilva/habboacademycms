<div class="user-menu">
    <a class="button" href="{{ route('habboacademy.topics.create') }}" data-toggle="tooltip" data-placement="left" title="Postar tópico"><i class="fas fa-pencil-alt"></i></a>
    <a class="button" data-toggle="tooltip" data-placement="left" title="Meus tópicos"><i class="fas fa-pen-square"></i></a>
    <a class="button" data-toggle="tooltip" data-placement="left" title="Configurações da Conta"><i class="fas fa-cog"></i></a>
    <div class="picture">
        <div class="head" style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user={{ auth()->user()->username }}&direction=3&head_direction=3&gesture=sml&headonly=1&size=m')"></div>
        <div class="body" style="background-image: url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user={{ auth()->user()->username }}&direction=3&head_direction=3&gesture=sml&size=s')"></div>
    </div>
    <a class="button" data-toggle="tooltip" data-placement="left" title="Sair"><i class="fas fa-sign-out-alt"></i></a>
</div>