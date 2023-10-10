<?php

namespace Siiau\ApiClient\Objects;

final class Token
{
    public function __construct(
        public readonly string $value,
        public readonly string $type,
    ) {}
}
