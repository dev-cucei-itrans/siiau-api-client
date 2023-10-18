<?php

namespace Siiau\ApiClient\Objects;

final class Token
{
    public function __construct(
        public readonly string $value,
        public readonly string $type,
        /** @var int|null $expiresIn Time in seconds the token expires */
        public readonly ?int $expiresIn = null,
    ) {}
}
