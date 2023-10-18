<?php

namespace Siiau\ApiClient\Objects;

final class Universidad
{
    public function __construct(
        public readonly string $campus,
        public readonly ?string $sede = null,
    ) {}
}
