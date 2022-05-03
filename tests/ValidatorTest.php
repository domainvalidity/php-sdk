<?php

namespace Domainvalidity\Sdk\Tests;

use Domainvalidity\Sdk\Factory;
use Domainvalidity\Sdk\Host;
use Domainvalidity\Sdk\Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testInstance(): void
    {
        $validator = new Validator(new Client([
            'base_uri' => Factory::PRODUCTION_HOST,
        ]));

        $this->assertInstanceOf(Validator::class, $validator);
    }

    public function testValidate(): void
    {
        $mock = new MockHandler ([
            new Response(
                status: 200,
                headers: ['content-type' => 'application/json'],
                body: '{"valid":true,"original":"https:\/\/api.domainvalidity.dev","host":"api.domainvalidity.dev","domain":"domainvalidity.dev","tld":"dev"}'
            ),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client([
            'handler' => $handlerStack,
            'base_uri' => Factory::PRODUCTION_HOST,
        ]);

        $validator = new Validator($client);

        $host = $validator->validate(Factory::PRODUCTION_HOST);

        $this->assertInstanceOf(Host::class, $host);
        $this->assertSame(Factory::PRODUCTION_HOST, $host->original());
        $this->assertSame('dev', $host->tld());
        $this->assertSame('domainvalidity.dev', $host->domain());
    }
}
