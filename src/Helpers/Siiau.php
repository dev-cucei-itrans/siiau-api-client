<?php

use Siiau\ApiClient\Facades\Siiau;

if (!function_exists('siiau')) {
    function siiau()
    {
        return Siiau::getFacadeRoot();
    }
}