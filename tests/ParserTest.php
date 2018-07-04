<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Parser;

class ParserTest extends TestCase
{
    protected $sites = ['laravel-news.com', 'kramatorsk.info', 'friend-kramatorsk.store', 'kram-hospital.store'];

    public function test_get_tag_content()
    {
        $parser = new Parser($this->sites);

        $tags = $parser->getTagContent('p');

        foreach ($tags as $tag) {
            $this->assertInternalType('array', $tag);
        }

    }

    public function test_get_meta_tag()
    {
        $parser = new Parser($this->sites);

        $tags = $parser->getMetaTags();

        foreach ($tags as $tag) {
            $this->assertInternalType('array', $tag);
        }
    }
}