<?php

namespace Siiau\ApiClient\Objects;

final class Fecha
{
    public function __construct(
        public readonly ?string $fechaInicio,
        public readonly ?string $fechaFin,
    ) {}
}
