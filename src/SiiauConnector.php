<?php

namespace Siiau\ApiClient;

use Siiau\ApiClient\Resources\{AlumnoResource, CarreraResource, UsuarioResource, KardexResource, MateriaResource};
use Saloon\Http\{Connector, Response};
use Siiau\ApiClient\Exceptions\{ClientException, InternalServerErrorException, NotFoundException, ServerException, SiiauRequestException};
use Throwable;

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

    /**
     * Obtiene el recurso de materia.
     */
    public function materia(): MateriaResource
    {
        return new MateriaResource($this);
    }

    /**
     * Obtiene el recurso de kardex.
     */
    public function kardex(): KardexResource
    {
        return new KardexResource($this);
    }

    /**
     * Obtiene el recurso de carrera.
     */
    public function carrera(): CarreraResource
    {
        return new CarreraResource($this);
    }

    public function shouldThrowRequestException(Response $response): bool
    {
        return false;
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
