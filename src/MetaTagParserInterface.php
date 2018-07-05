<?php

namespace App;

interface MetaTagParserInterface
{
    public function getMetaTags(string $content): array;
}