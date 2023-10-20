<?php

namespace Siiau\ApiClient\Extensions;

use Illuminate\Contracts\Auth\{Authenticatable, UserProvider};
use Siiau\ApiClient\Contracts\SiiauAuthenticable;
use Siiau\ApiClient\SiiauConnector;

final class SiiauUserProvider implements UserProvider
{
    public function __construct(
        private readonly UserProvider $userProvider,
        private readonly SiiauConnector $siiau,
    ) {}

    /**
     * @inheritdoc
     */
    public function retrieveById(mixed $identifier): ?Authenticatable
    {
        return $this->userProvider->retrieveById($identifier);
    }

    /**
     * @inheritdoc
     */
    public function retrieveByToken(mixed $identifier, mixed $token): ?Authenticatable
    {
        return $this->userProvider->retrieveByToken($identifier, $token);
    }

    /**
     * @inheritdoc
     */
    public function updateRememberToken(Authenticatable $user, mixed $token): void
    {
        $this->userProvider->updateRememberToken($user, $token);
    }

    /**
     * @inheritdoc
     */
    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        return $this->userProvider->retrieveByCredentials($credentials);
    }

    /**
     * @inheritdoc
     */
    public function validateCredentials(Authenticatable|SiiauAuthenticable $user, array $credentials): bool
    {
        if (! $user instanceof SiiauAuthenticable || is_null($password = $credentials['password'] ?? null)) {
            return false;
        }

        return $this->siiau->usuario()->credencialesValidas(
            codigo: $user->getCodigo(),
            password: $password,
        );
    }
}
