<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\CachePlugin\Traits\HasCaching;
use Siiau\ApiClient\Attributes\NonAuthenticable;
use Siiau\ApiClient\Objects\{Error, Token};
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Exceptions\InvalidCredentialsException;
use Throwable;
use Saloon\CachePlugin\Contracts\{Cacheable, Driver};

#[NonAuthenticable]
final class LoginRequest extends Request implements HasBody, Cacheable
{
    use HasJsonBody;
    use HasCaching;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $email,
        private readonly string $password,
        private readonly Driver $driver,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/login';
    }

    protected function defaultBody(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function getRequestException(
        Response $response,
        ?Throwable $senderException,
    ): ?Throwable {
        return match (true) {
            $response->clientError() => InvalidCredentialsException::fromResponse($response, $senderException),
            default => null,
        };
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): Token|Error
    {
        if ($response->failed()) {
            return new Error($response->body());
        }

        return new Token(
            value: $response->json('token'),
            type: 'Bearer',
        );
    }

    protected function getCacheableMethods(): array
    {
        return [Method::GET, Method::OPTIONS, Method::POST];
    }

    public function resolveCacheDriver(): Driver
    {
        return $this->driver;
    }

    public function cacheExpiryInSeconds(): int
    {
        return 1800; // 30 min
    }
}
