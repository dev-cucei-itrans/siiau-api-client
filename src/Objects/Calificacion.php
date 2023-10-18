<?php

namespace Siiau\ApiClient\Objects;

final class Calificacion
{
    public function __construct(
        public readonly ?string $valor,
        public readonly ?string $tipo,
    ) {}
}
