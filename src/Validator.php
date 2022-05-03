<?php

namespace Domainvalidity\Sdk;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;

class Validator
{
    public function __construct(
        protected ClientInterface $client,
        protected array $hash = [],
    ) {
    }

    public function validate(string $host): Host
    {
        $response = $this->client->sendRequest(
            new Request(
                method: 'GET',
                uri: '/validate?host=' . $host,
            )
        );

        $data = json_decode(
            $response
                ->getBody()
                ->getContents(),
            true
        );

        $this->hash[$host] = new Host(
            valid: $data['valid'] ?? false,
            original: $data['original'] ?? $host,
            host: $data['host'] ?? null,
            domain: $data['domain'] ?? null,
            tld: $data['tld'] ?? null,
        );

        return $this->hash[$host];
    }
}
