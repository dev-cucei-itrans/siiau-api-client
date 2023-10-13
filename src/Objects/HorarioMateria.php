<?php

namespace Siiau\ApiClient\Objects;

final class HorarioMateria
{
    public function __construct(
        public readonly string $hora,
        public readonly string $edificio,
        public readonly string $aula,
        public readonly ?array $dias = [],
    ) {}
}
