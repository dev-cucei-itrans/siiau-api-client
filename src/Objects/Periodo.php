<?php

namespace Siiau\ApiClient\Objects;

final class Periodo
{
    public function __construct(
        public readonly ?string $inicio = null,
        public readonly ?string $fin = null,
    ) {}
}
