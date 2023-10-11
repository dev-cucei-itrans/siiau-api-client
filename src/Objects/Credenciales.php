<?php

namespace Siiau\ApiClient\Objects;

final class Credenciales
{
    public function __construct(
        public readonly string $credencialesValidas,
    ) {}
}