<?php

namespace Siiau\ApiClient\Facades;

use Illuminate\Support\Facades\Facade;
use Siiau\ApiClient\SiiauConnector;

/**
 * @mixin SiiauConnector
 */
final class Siiau extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SiiauConnector::class;
    }
}
