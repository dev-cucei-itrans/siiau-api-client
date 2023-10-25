<?php

namespace Siiau\ApiClient;

use Siiau\ApiClient\Resources\{AlumnoResource, CarreraResource, UsuarioResource, KardexResource, MateriaResource};
use Saloon\Http\{Connector, PendingRequest, Response};
use Siiau\ApiClient\Exceptions\{ClientException, ForbiddenException, InternalServerErrorException, NotFoundException, ServerException, SiiauRequestException};
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

    public function boot(PendingRequest $pendingRequest): void
    {
        try {
            //code...
        } catch (ForbiddenException) {
            //throw $th;
        }
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

    public function hasRequestFailed(Response $response): ?bool
    {
        return str_contains($response->body(), '{"status":"Token is Invalid"}');
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
            str_contains($response->body(), '{"status":"Token is Invalid"}') => ForbiddenException::fromResponse($response, $senderException),
            default                     => SiiauRequestException::fromResponse($response, $senderException),
        };
    }
}
