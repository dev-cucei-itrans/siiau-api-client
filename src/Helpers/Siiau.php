<?php

use Siiau\ApiClient\Facades\Siiau;
use Siiau\ApiClient\SiiauConnector;

if (!function_exists('siiau')) {
    function siiau(): SiiauConnector
    {
        return Siiau::getFacadeRoot();
    }
}