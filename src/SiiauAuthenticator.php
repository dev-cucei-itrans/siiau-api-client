<?php

namespace Siiau\ApiClient;

use Siiau\ApiClient\Attributes\NonAuthenticable;
use Siiau\ApiClient\Exceptions\InvalidCredentialsException;
use Siiau\ApiClient\Objects\Token;
use Siiau\ApiClient\Requests\LoginRequest;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;
use Throwable;

final class SiiauAuthenticator implements Authenticator
{
    public function __construct(
        public readonly LoginRequest $login,
    ) {}

    /**
     * @throws Throwable|InvalidCredentialsException
     */
    public function set(PendingRequest $pendingRequest): void
    {
        if (NonAuthenticable::belongsTo($pendingRequest->getRequest())) {
            return;
        }

        $response = $pendingRequest
            ->getConnector()
            ->send($this->login);

        if ($response->failed()) {
            throw new InvalidCredentialsException(
                request: $this->login,
                response: $response,
            );
        }

        $token = $response->dto();
        assert($token instanceof Token);

        $pendingRequest->headers()->add('Authorization', "$token->type $token->value");
    }
}
