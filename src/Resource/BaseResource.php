<?php

namespace Saloon\Http;

class BaseResource
{
    public function __construct(readonly protected Connector $connector)
    {
        //
    }
}