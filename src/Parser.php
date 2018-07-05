<?php

namespace App;

class Parser implements MetaTagParserInterface, TagContentParserInterface
{
    protected const META_TAG_PATTERN = '/\<meta.*"(?P<prop>.*)".*"(?P<value>.*)"[^>]*>/';

    protected const TAG_PATTERN = '/<%s[^>]*>(?P<value>.*)<\/%s>/';

    public function getMetaTags(string $content): array
    {
        preg_match_all(self::META_TAG_PATTERN, $content, $matches);

        return array_combine($matches['prop'], $matches['value']);
    }

    public function getTagContent(string $tag, string $content): array
    {
        preg_match_all(sprintf(self::TAG_PATTERN, $tag, $tag), $content, $matches);

        return $matches['value'];
    }
}