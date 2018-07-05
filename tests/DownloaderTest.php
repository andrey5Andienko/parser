<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Downloader;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;

class DownloaderTest extends TestCase
{
    public function test_download()
    {
        $body = 'TEST_BODY_SHEET';
        $headers = [
            ['test' => 'TEST_HEADER'],
            ['test1' => 'TEST_HEADER1'],
        ];

        $mock = new MockHandler([
            new Response(200, $headers, $body)
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $downloader = new Downloader($client);

        $response = $downloader->download(['/'])->current();

        $this->assertSame($body, (string)$response->getBody());
        $this->assertSame($headers[0], $response->getHeaders()[0]);
        $this->assertSame($headers[1], $response->getHeaders()[1]);
    }
}