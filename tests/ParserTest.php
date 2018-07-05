<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Parser;

class ParserTest extends TestCase
{
    public function test_get_tag_content()
    {
        $parser = new Parser;

        $html = "<p>wedfwefwfwef</p>";

        $result = $parser->getTagContent('p', $html);

        $this->assertCount(1, $result);

    }

    public function test_get_meta_tag()
    {
        $parser = new Parser;

        $meta = "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";

        $result = $parser->getMetaTags($meta);

        $this->assertCount(1, $result);
    }
}