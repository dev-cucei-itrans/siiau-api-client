<?php

declare(strict_types=1);

namespace Siiau\ApiClient;

use Saloon\Http\PendingRequest;
use Siiau\ApiClient\Attributes\NonAuthenticable;
use Siiau\ApiClient\Objects\Token;
use Siiau\ApiClient\Requests\LoginRequest;
use Saloon\Contracts\Authenticator;
use Throwable;

final class SiiauAuthenticator implements Authenticator
{
    public function __construct(
        public readonly LoginRequest $login,
    ) {}

    /**
     * @throws Throwable
     */
    public function set(PendingRequest $pendingRequest): void
    {
        if (NonAuthenticable::belongsTo($pendingRequest->getRequest())) {
            return;
        }

        $response = $pendingRequest
            ->getConnector()
            ->send($this->login)
            ->throw();

        $token = $response->dto();
        assert($token instanceof Token);

        $pendingRequest->headers()->add('Authorization', "$token->type $token->value");
    }
}
