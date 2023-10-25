<?php

namespace Siiau\ApiClient\Requests;

use Illuminate\Support\Facades\Cache;
use JsonException;
use Saloon\CachePlugin\Traits\HasCaching;
use Siiau\ApiClient\Attributes\NonAuthenticable;
use Siiau\ApiClient\Objects\{Error, Token};
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{PendingRequest, Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Exceptions\InvalidCredentialsException;
use Throwable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;

#[NonAuthenticable]
final class LoginRequest extends Request implements HasBody, Cacheable
{
    use HasJsonBody;
    use HasCaching;

    protected function getCacheableMethods(): array
    {
        return [Method::GET, Method::OPTIONS, Method::POST];
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(Cache::store());
    }
    
    public function cacheExpiryInSeconds(): int
    {
        return 1800;
    }

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $email,
        private readonly string $password,
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
        ?Throwable $senderException
    ): ?Throwable {
        return match (true) {
            $response->clientError() => InvalidCredentialsException::fromResponse($response, $senderException),
            default => null
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
}
