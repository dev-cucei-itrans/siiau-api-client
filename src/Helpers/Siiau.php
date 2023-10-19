<?php

use Siiau\ApiClient\SiiauConnector;

if (! function_exists('siiau')) {
    function siiau(): SiiauConnector
    {
        return app(SiiauConnector::class);
    }
}
