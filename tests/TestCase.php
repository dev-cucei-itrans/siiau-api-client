<?php

namespace Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Siiau\ApiClient\SiiauApiClientServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use WithWorkbench;

    /**
     * @inheritDoc
     */
    final protected function getPackageProviders(mixed $app): array
    {
        return [
            SiiauApiClientServiceProvider::class,
        ];
    }
}
