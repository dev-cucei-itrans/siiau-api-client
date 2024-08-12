<?php

declare(strict_types=1);

use Siiau\ApiClient\SiiauConnector;

if (! function_exists('siiau')) {
    function siiau(): SiiauConnector
    {
        return app(SiiauConnector::class);
    }
}
