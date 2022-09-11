<nav class="menu customTransition">
    <div class="container">
        <ul class="principal-list">
            @foreach (getNavigations() as $navigation)
            <li class="item-menu">
                <a href="{{ $navigation->slug }}" class="title-menu">
                    <span>{{ $navigation->label }}</span>
                    <div class="icon-menu" style="background-image: url('{{ $navigation->hover_icon }}')"></div>
                </a>
                @if ($navigation->subNavigations->count())
                <div class="drop-menu">
                    <ul>
                        @foreach ($navigation->subNavigations as $subNavigation)
                        <li>
                            <a @if ($subNavigation->new_tab) target="_blank" @endif href="{{ $subNavigation->slug }}">
                                {{ $subNavigation->label }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </li>
            @endforeach
            <li class="user-club">
                <button class="club-modal">
                    Entrar
                    <i class="fa-regular fa-circle-user ml-2"></i>
                </button>
            </li>
        </ul>
    </div>
</nav>
