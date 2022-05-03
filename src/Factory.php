<?php

namespace Domainvalidity\Sdk;

use GuzzleHttp\Client;

class Factory
{
    public const PRODUCTION_HOST = 'https://api.domainvalidity.dev';

    public static function make(?bool $stage = null): Validator
    {
        return new Validator(new Client([
            'base_uri' => self::PRODUCTION_HOST,
        ]));
    }
}
