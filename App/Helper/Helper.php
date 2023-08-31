<?php

namespace App\Helper;

class Helper
{
    public static function tableOfContents(): array
    {
        $content = get_post_field('post_content', get_the_ID());
        preg_match_all('@<h2.*?>(.*?)<\/h2>@', $content, $matches, PREG_PATTERN_ORDER);
        return array_filter($matches[1]);
    }
}