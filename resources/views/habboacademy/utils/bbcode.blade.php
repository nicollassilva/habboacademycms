<button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[b]" data-bbcode-after="[/b]" data-bbcode title="Negrito">
    <i class="fa fa-bold ">
    </i>
</button>
<button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[i]" data-bbcode-after="[/i]" data-bbcode title="Itálico">
    <i class="fa fa-italic ">
    </i>
</button>
<button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[u]" data-bbcode-after="[/u]" data-bbcode title="Underline">
    <i class="fa fa-underline ">
    </i>
</button>
<button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[s]" data-bbcode-after="[/s]" data-bbcode title="Escrita Tachada">
    <i class="fa fa-strikethrough ">
    </i>
</button>
@if ($type === 2)
<button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[img]" data-bbcode-after="[/img]" data-bbcode title="Inserir Imagem">
    <i class="far fa-image ">
    </i>
</button>
@endif
<button type="button" data-toggle="tooltip" data-bbcode-el="moreButtons" data-type="colors{{ explode('#', $element)[1] }}" data-bbcode title="Cores para Letra">
    <i class="fa fa-tint">
    </i>
    <i class="fa fa-chevron-down" style="font-size: 7px; opacity: 0.5;">
    </i>
</button>
<button type="button" data-toggle="tooltip" data-bbcode-el="moreButtons" data-type="emoji{{ explode('#', $element)[1] }}" data-bbcode title="Emoticons">
    <i class="fas fa-grin-alt"></i>
    <i class="fa fa-chevron-down" style="font-size: 7px; opacity: 0.5;"></i>
</button>
@if ($type === 2)
    <button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[center]" data-bbcode-after="[/center]" data-bbcode title="Centralizar">
        <i class="fa fa-align-center">
        </i>
    </button>
    <button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[url=LINK]" data-bbcode-after="[/url]" data-bbcode title="Inserir URL">
        <i class="fa fa-link"></i>
    </button>
    <button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[youtube]" data-bbcode-after="[/youtube]" data-bbcode title="Inserir Vídeo">
        <i class="fab fa-youtube"></i>
    </button>
    <button type="button" data-toggle="tooltip" data-bbcode-el="{{ $element; }}" data-bbcode-before="[quote]" data-bbcode-after="[/quote]" data-bbcode title="Citar">
        <i class="fa fa-quote-left"></i>
    </button>
    <button type="button" data-toggle="tooltip" data-bbcode-el="moreButtons" data-type="fontSize{{ explode('#', $element)[1] }}" data-bbcode title="Tamanho da Letra">
        <i class="fa fa-font"></i>
        <i class="fa fa-chevron-down" style="font-size: 7px; opacity: 0.5;"></i>
    </button>
    <div class="moreButtons" id="fontSize{{ explode('#', $element)[1] }}">
        <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[size=1]" data-bbcode-after="[/size]" data-bbcode>Minúscula
        </button>
        <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[size=2]" data-bbcode-after="[/size]" data-bbcode>Pequena
        </button>
        <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[size=3]" data-bbcode-after="[/size]" data-bbcode>Normal
        </button>
        <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[size=4]" data-bbcode-after="[/size]" data-bbcode>Grande
        </button>
        <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[size=5]" data-bbcode-after="[/size]" data-bbcode>Enorme
        </button>
    </div>
    @endif
<div class="moreButtons" id="emoji{{ explode('#', $element)[1] }}">
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=iloved]" class="emoji" data-bbcode-after="" data-bbcode title="Amei">
        <img src="/images/emojis/iloved.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=drooling]" class="emoji" data-bbcode-after="" data-bbcode title="Babando">
        <img src="/images/emojis/drooling.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=kiss]" class="emoji" data-bbcode-after="" data-bbcode title="Beijinho">
        <img src="/images/emojis/kiss.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=tired]" class="emoji" data-bbcode-after="" data-bbcode title="Cansado">
        <img src="/images/emojis/tired.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=bold]" class="emoji" data-bbcode-after="" data-bbcode title="Se achando">
        <img src="/images/emojis/bold.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=sleeping]" class="emoji" data-bbcode-after="" data-bbcode title="Chorando">
        <img src="/images/emojis/sleeping.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=embarrassed]" class="emoji" data-bbcode-after="" data-bbcode title="Envergonhado">
        <img src="/images/emojis/embarrassed.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=sleeping]" class="emoji" data-bbcode-after="" data-bbcode title="Dormindo">
        <img src="/images/emojis/sleeping.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=happy]" class="emoji" data-bbcode-after="" data-bbcode title="Feliz">
        <img src="/images/emojis/happy.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=wink]" class="emoji" data-bbcode-after="" data-bbcode title="Piscadinha">
        <img src="/images/emojis/wink.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=happy]" class="emoji" data-bbcode-after="" data-bbcode title="Rindo">
        <img src="/images/emojis/happy.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=rage]" class="emoji" data-bbcode-after="" data-bbcode title="Raiva">
        <img src="/images/emojis/rage.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-toggle="tooltip" data-bbcode-before="[emoji=sad]" class="emoji" data-bbcode-after="" data-bbcode title="Triste">
        <img src="/images/emojis/sad.webp" />
    </button>
</div>
<div class="moreButtons cor" id="colors{{ explode('#', $element)[1] }}">
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=gray]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=blue]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=green]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=yellow]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=orange]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=red]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=darkblue]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=pink]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=marine]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=black]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
</div>