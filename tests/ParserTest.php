<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Parser;

class ParserTest extends TestCase
{
    public function test_get_tag_content()
    {
        $parser = new Parser;

        $html = "<p>111111111111</p>";

        $result = $parser->getTagContent('p', $html);

        $this->assertCount(1, $result);

        $html .= PHP_EOL . "<p>222222222222</p>";

        $result2 = $parser->getTagContent('p', $html);

        $this->assertCount(2, $result2);
    }

    public function test_get_meta_tag()
    {
        $parser = new Parser;

        $meta = "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";

        $result = $parser->getMetaTags($meta);

        $this->assertCount(1, $result);

        $meta .= PHP_EOL . "<meta name=\"viewport2\" content=\"width=device-width, initial-scale=2\">";

        $result2 = $parser->getMetaTags($meta);

        $this->assertCount(2, $result2);
    }
}