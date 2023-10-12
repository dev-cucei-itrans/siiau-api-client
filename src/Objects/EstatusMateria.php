<?php

namespace Siiau\ApiClient\Objects;

final class EstatusMateria
{
    public function __construct(
        public readonly ?string $calificacion,
        public readonly ?string $tipo,
    ) {}
}
