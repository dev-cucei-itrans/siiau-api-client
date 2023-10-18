<?php

namespace Siiau\ApiClient;

use Siiau\ApiClient\Resources\{AlumnoResource, UsuarioResource};
use Saloon\Http\{Connector, Response};
use Siiau\ApiClient\Exceptions\{ClientException, InternalServerErrorException, NotFoundException, ServerException, SiiauRequestException};
use Throwable;
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

    /**
     * Obtiene el recurso de alumno.
     */
    public function alumno(): AlumnoResource
    {
        return new AlumnoResource($this);
    }

    /**
     * Obtiene el recurso de usuario.
     */
    public function usuario(): UsuarioResource
    {
        return new UsuarioResource($this);
    }

    public function general(): GeneralResource
    {
        return new GeneralResource($this);
    }

    public function getRequestException(
        Response $response,
        ?Throwable $senderException
    ): ?Throwable {
        return match (true) {
            $response->status() === 404 => NotFoundException::fromResponse($response, $senderException),
            $response->clientError()    => ClientException::fromResponse($response, $senderException),
            $response->status() === 500 => InternalServerErrorException::fromResponse($response, $senderException),
            $response->serverError()    => ServerException::fromResponse($response, $senderException),
            default                     => SiiauRequestException::fromResponse($response, $senderException),
        };
    }
}
