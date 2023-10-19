<?php

namespace Siiau\ApiClient\Objects;

final class Creditos
{
    public function __construct(
        public readonly string $adquiridos,
        public readonly string $requeridos,
    ) {}
}
