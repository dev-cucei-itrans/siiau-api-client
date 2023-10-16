<?php

namespace Siiau\ApiClient;

use Saloon\Http\Connector;
use Siiau\ApiClient\Resources\{AlumnoResource, GeneralResource, UsuarioResource};

final class SiiauConnector extends Connector
{
    public function __construct(
        private readonly string $url,
    ) {}

    public function resolveBaseUrl(): string
    {
        return $this->url;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function alumno(): AlumnoResource
    {
        return new AlumnoResource($this);
    }

    public function usuario(): UsuarioResource
    {
        return new UsuarioResource($this);
    }

    public function general(): GeneralResource
    {
        return new GeneralResource($this);
    }
}
