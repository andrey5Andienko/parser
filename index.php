<?php
require __DIR__ . '/vendor/autoload.php';

use App\Parser;

$arr = ['laravel-news.com', 'kramatorsk.info', 'friend-kramatorsk.store', 'kram-hospital.store'];

$site = new Parser($arr);

$tags = $site->getTagContent('p');

$meta = $site->getMetaTags();

