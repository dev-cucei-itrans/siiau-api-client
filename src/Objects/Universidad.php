<?php

namespace Siiau\ApiClient\Objects;

final class Universidad
{
    public function __construct(
        public readonly ?string $sede,
        public readonly string $campus,
    ) {}
}
