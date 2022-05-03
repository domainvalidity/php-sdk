<?php

namespace Domainvalidity\Sdk\Tests;

use Domainvalidity\Sdk\Factory;
use Domainvalidity\Sdk\Validator;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testMake(): void
    {
        $validator = Factory::make();

        $this->assertInstanceOf(Validator::class, $validator);
    }
}
