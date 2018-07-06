<?php

namespace App;

class Parser implements MetaTagParserInterface, TagContentParserInterface
{
    protected const META_TAG_PATTERN = '/\<meta.*"(?P<prop>.*)".*"(?P<value>.*)"[^>]*>/';

    protected const TAG_PATTERN = '/<%s[^>]*>(?P<value>.*)<\/%s>/';

    /** @var string */
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getMetaTags(): array
    {
        preg_match_all(self::META_TAG_PATTERN, $this->content, $matches);

        if (count($matches['prop']) === count($matches['value'])) {

            return array_combine($matches['prop'], $matches['value']);
        }
    }

    public function getTagContent(string $tag): array
    {
        preg_match_all(sprintf(self::TAG_PATTERN, $tag, $tag), $this->content, $matches);

        return $matches['value'];
    }
}