<?php

namespace App;

use GuzzleHttp\Client;
use Generator;

class Parser
{
    /**
     * @var array
     */
    protected $urls;

    /**
     * @var Client
     */
    protected $client;

    public function __construct(array $urls, array $config = [])
    {
        $this->urls = $urls;
        $this->client = new Client($config);
    }

    public function getMetaTags()
    {
        $pattern = '/\<meta.*"(?P<prop>.*)".*"(?P<value>.*)"[^>]*>/';

        foreach ($this->getBodies() as $content) {
            $url = $content['url'];
            preg_match_all($pattern, $content['body'], $matches);
            $meta[$url] = array_combine($matches['prop'], $matches['value']);
        }

        return $meta;
    }

    public function getTagContent($tag)
    {
        $pattern = '/<' . $tag . '[^>]*>(?P<value>.*)<\/' . $tag . '>/';

        foreach ($this->getBodies() as $content) {
            $url = $content['url'];
            preg_match_all($pattern, $content['body'], $matches);
            $tagContent[$url] = $matches['value'];
        }

        return $tagContent;
    }

    protected function sendGetRequest(): Generator
    {
        foreach ($this->urls as $url) {
            yield  [
                'url' => $url,
                'response' => $this->client->get($url)
            ];
        }
    }

    protected function getBodies()
    {
        $generator = $this->sendGetRequest();

        foreach ($generator as $response) {
            yield [
                'url' => $response['url'],
                'body' => $response['response']->getBody()
            ];
        }
    }
}