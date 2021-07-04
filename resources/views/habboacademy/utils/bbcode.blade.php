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
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=amei]" class="emoji" data-bbcode-after="" data-bbcode title="Amei">
        <img src="/images/emojis/amei.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=babando]" class="emoji" data-bbcode-after="" data-bbcode title="Babando">
        <img src="/images/emojis/babando.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=beijinho]" class="emoji" data-bbcode-after="" data-bbcode title="Beijinho">
        <img src="/images/emojis/beijinho.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=cansado]" class="emoji" data-bbcode-after="" data-bbcode title="Cansado">
        <img src="/images/emojis/cansado.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=seachando]" class="emoji" data-bbcode-after="" data-bbcode title="Se achando">
        <img src="/images/emojis/seachando.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=chorando]" class="emoji" data-bbcode-after="" data-bbcode title="Chorando">
        <img src="/images/emojis/chorando.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=envergonhado]" class="emoji" data-bbcode-after="" data-bbcode title="Envergonhado">
        <img src="/images/emojis/envergonhado.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=dormindo]" class="emoji" data-bbcode-after="" data-bbcode title="Dormindo">
        <img src="/images/emojis/dormindo.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=feliz]" class="emoji" data-bbcode-after="" data-bbcode title="Feliz">
        <img src="/images/emojis/feliz.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=piscadinha]" class="emoji" data-bbcode-after="" data-bbcode title="Piscadinha">
        <img src="/images/emojis/piscadinha.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=rindo]" class="emoji" data-bbcode-after="" data-bbcode title="Rindo">
        <img src="/images/emojis/rindo.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=raiva]" class="emoji" data-bbcode-after="" data-bbcode title="Raiva">
        <img src="/images/emojis/raiva.webp" />
    </button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[emoji=triste]" class="emoji" data-bbcode-after="" data-bbcode title="Triste">
        <img src="/images/emojis/triste.webp" />
    </button>
</div>
<div class="moreButtons cor" id="colors{{ explode('#', $element)[1] }}">
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=cinzento]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=azul]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=verde]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=amarelo]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=laranja]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=vermelho]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=azulEscuro]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=rosa]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=marinho]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
    <button type="button" data-bbcode-el="{{ $element; }}" data-bbcode-before="[color=preto]" data-bbcode-after="[/color]" data-bbcode><span></span></button>
</div>