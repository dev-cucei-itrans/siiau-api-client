<?php

namespace Siiau\ApiClient;

use Saloon\Http\Connector;

final class SiiauConnector extends Connector
{
    public function __construct(
        private readonly string $url,
    ) {}

    public function resolveBaseUrl(): string
    {
        return $this->url;
    }
}
