<?php

declare(strict_types=1);

namespace Siiau\ApiClient;

use Siiau\ApiClient\Resources\{AlumnoResource, CarreraResource, UsuarioResource, KardexResource, MateriaResource};
use Saloon\Http\{Connector, Request, Response};
use Siiau\ApiClient\Exceptions\{ClientException,
    InternalServerErrorException,
    InvalidTokenException,
    TooManyRequestsException,
    UnauthorizedException,
    NotFoundException,
    ServerException,
    SiiauRequestException};
use Saloon\Exceptions\Request\{FatalRequestException, RequestException};
use Throwable;

final class SiiauConnector extends Connector
{
    public ?int $tries = 3;

    public ?int $retryInterval = 3000;

    public ?bool $throwOnMaxTries = false;

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
        ?Throwable $senderException,
    ): ?Throwable {
        return match (true) {
            hasInvalidToken($response)  => InvalidTokenException::fromResponse($response, $senderException),
            $response->status() === 401 => UnauthorizedException::fromResponse($response, $senderException),
            $response->status() === 404 => NotFoundException::fromResponse($response, $senderException),
            $response->status() === 429 => TooManyRequestsException::fromResponse($response, $senderException),
            $response->clientError()    => ClientException::fromResponse($response, $senderException),
            $response->status() === 500 => InternalServerErrorException::fromResponse($response, $senderException),
            $response->serverError()    => ServerException::fromResponse($response, $senderException),
            default                     => SiiauRequestException::fromResponse($response, $senderException),
        };
    }

    public function handleRetry(FatalRequestException|RequestException $exception, Request $request): bool
    {
        // En caso de un Fatal request o un server error, intentamos de nuevo.
        if (
            $exception instanceof FatalRequestException ||
            $exception->getResponse()->serverError()
        ) {
            return true;
        }

        // Si fue un problema con el token, lo invalidamos y reintentamos.
        if (
            $exception instanceof InvalidTokenException &&
            ($authenticator = $this->getAuthenticator()) &&
            $authenticator instanceof SiiauAuthenticator
        ) {
            $authenticator->login->invalidateCache();

            return true;
        }

        return false;
    }
}

function hasInvalidToken(Response $response): bool
{
    return preg_match(
        '/{"status":"(Token is Invalid|Token is Expired|Authorization Token not found)"}/',
        $response->body(),
    ) === 1;
}
