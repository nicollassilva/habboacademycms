<?php

namespace App\Services;

class UserCodeService
{
    public static function render($text, $type = 1)
    {
        if ($type == 2) {
            $array = array(
                '/\[b\](.*?)\[\/b\]/' => '<b>$1</b>',
                '/\[u\](.*?)\[\/u\]/' => '<u>$1</u>',
                '/\[i\](.*?)\[\/i\]/' => '<i>$1</i>',
                '/\[s\](.*?)\[\/s\]/' => '<s>$1</s>',
                '/\[url=(.*?)\](.*?)\[\/url\]/' => '<a href="$1" target="_blank" data-toggle="tooltip" title="Ao clicar você será redirecionado ao link, tome cuidado!">$2</a>',
                '/\[img\](.*?)\[\/img\]/' => '<img src="$1">',
                '/\[youtube\]https:\/\/www.youtube.com\/watch\?v=(.*?)\[\/youtube\]/' => '<iframe width="500" height="350" frameBorder="no" scrolling="no" src="https://www.youtube.com/embed/$1"></iframe>',
                '/\[center\](.*?)\[\/center\]/is' => '<center>$1</center>',
                '/\[color=gray\](.*?)\[\/color\]/is' => '<span style="color: #607d8b;">$1</span>',
                '/\[color=blue\](.*?)\[\/color\]/is' => '<span style="color: #3aa8ce;">$1</span>',
                '/\[color=green\](.*?)\[\/color\]/is' => '<span style="color: #80d500;">$1</span>',
                '/\[color=yellow\](.*?)\[\/color\]/is' => '<span style="color: #ffbc00;">$1</span>',
                '/\[color=orange\](.*?)\[\/color\]/is' => '<span style="color: #D96D00;">$1</span>',
                '/\[color=red\](.*?)\[\/color\]/is' => '<span style="color: #f82a2a;">$1</span>',
                '/\[color=darkblue\](.*?)\[\/color\]/is' => '<span style="color: #145b73;">$1</span>',
                '/\[color=pink\](.*?)\[\/color\]/is' => '<span style="color: #ff008d;">$1</span>',
                '/\[color=marine\](.*?)\[\/color\]/is' => '<span style="color: #00aeae;">$1</span>',
                '/\[color=black\](.*?)\[\/color\]/is' => '<span style="color: #A300D9;">$1</span>',
                '/\[size=1\](.*?)\[\/size\]/is' => '<span style="font-size: 0.675rem;">$1</span>',
                '/\[size=2\](.*?)\[\/size\]/is' => '<span style="font-size: 0.775rem;">$1</span>',
                '/\[size=3\](.*?)\[\/size\]/is' => '<span style="font-size: 0.875rem;">$1</span>',
                '/\[size=4\](.*?)\[\/size\]/is' => '<span style="font-size: 0.975rem;">$1</span>',
                '/\[size=5\](.*?)\[\/size\]/is' => '<span style="font-size: 1.075rem;">$1</span>',
                '/\[quote\](.*?)\[\/quote\]/is' => '<blockquote>$1</blockquote>',
                '/\[emoji=iloved\]/' => '<img src="/images/emojis/iloved.webp" />',
                '/\[emoji=drooling\]/' => '<img src="/images/emojis/drooling.webp" />',
                '/\[emoji=kiss\]/' => '<img src="/images/emojis/kiss.webp" />',
                '/\[emoji=tired\]/' => '<img src="/images/emojis/tired.webp" />',
                '/\[emoji=bold\]/' => '<img src="/images/emojis/bold.webp" />',
                '/\[emoji=crying\]/' => '<img src="/images/emojis/crying.webp" />',
                '/\[emoji=embarrassed\]/' => '<img src="/images/emojis/embarrassed.webp" />',
                '/\[emoji=sleeping\]/' => '<img src="/images/emojis/sleeping.webp" />',
                '/\[emoji=happy\]/' => '<img src="/images/emojis/happy.webp" >',
                '/\[emoji=wink\]/' => '<img src="/images/emojis/wink.webp" />',
                '/\[emoji=laugh\]/' => '<img src="/images/emojis/laugh.webp" />',
                '/\[emoji=rage\]/' => '<img src="/images/emojis/rage.webp" />',
                '/\[emoji=sad\]/' => '<img src="/images/emojis/sad.webp" />'
            );

            if (strpos($text, '[quote]') !== false) {
                $count = substr_count($text, '[quote]');

                for ($i = 0; $i <= $count; $i++) {
                    $text = preg_replace(array_keys($array), array_values($array), $text);
                }
            }
        } else {
            $array = array(
                '/\[b\](.*?)\[\/b\]/' => '<b>$1</b>',
                '/\[u\](.*?)\[\/u\]/' => '<u>$1</u>',
                '/\[i\](.*?)\[\/i\]/' => '<i>$1</i>',
                '/\[s\](.*?)\[\/s\]/' => '<s>$1</s>',
                '/\[url=(.*?)\](.*?)\[\/url\]/' => '<a href="$1" target="_blank">$2</a>',
                '/\[center\](.*?)\[\/center\]/is' => '<center>$1</center>',
                '/\[color=gray\](.*?)\[\/color\]/is' => '<span style="color: #607d8b;">$1</span>',
                '/\[color=blue\](.*?)\[\/color\]/is' => '<span style="color: #3aa8ce;">$1</span>',
                '/\[color=green\](.*?)\[\/color\]/is' => '<span style="color: #80d500;">$1</span>',
                '/\[color=yellow\](.*?)\[\/color\]/is' => '<span style="color: #ffbc00;">$1</span>',
                '/\[color=orange\](.*?)\[\/color\]/is' => '<span style="color: #D96D00;">$1</span>',
                '/\[color=red\](.*?)\[\/color\]/is' => '<span style="color: #f82a2a;">$1</span>',
                '/\[color=darkblue\](.*?)\[\/color\]/is' => '<span style="color: #145b73;">$1</span>',
                '/\[color=pink\](.*?)\[\/color\]/is' => '<span style="color: #ff008d;">$1</span>',
                '/\[color=marine\](.*?)\[\/color\]/is' => '<span style="color: #00aeae;">$1</span>',
                '/\[color=black\](.*?)\[\/color\]/is' => '<span style="color: #A300D9;">$1</span>',
                '/\[emoji=iloved\]/' => '<img src="/images/emojis/iloved.webp" />',
                '/\[emoji=drooling\]/' => '<img src="/images/emojis/drooling.webp" />',
                '/\[emoji=kiss\]/' => '<img src="/images/emojis/kiss.webp" />',
                '/\[emoji=tired\]/' => '<img src="/images/emojis/tired.webp" />',
                '/\[emoji=bold\]/' => '<img src="/images/emojis/bold.webp" />',
                '/\[emoji=crying\]/' => '<img src="/images/emojis/crying.webp" />',
                '/\[emoji=embarrassed\]/' => '<img src="/images/emojis/embarrassed.webp" />',
                '/\[emoji=sleeping\]/' => '<img src="/images/emojis/sleeping.webp" />',
                '/\[emoji=happy\]/' => '<img src="/images/emojis/happy.webp" >',
                '/\[emoji=wink\]/' => '<img src="/images/emojis/wink.webp" />',
                '/\[emoji=laugh\]/' => '<img src="/images/emojis/laugh.webp" />',
                '/\[emoji=rage\]/' => '<img src="/images/emojis/rage.webp" />',
                '/\[emoji=sad\]/' => '<img src="/images/emojis/sad.webp" />'
            );
        }

        $text = preg_replace(array_keys($array), array_values($array), $text);

        return $text;
    }
}
