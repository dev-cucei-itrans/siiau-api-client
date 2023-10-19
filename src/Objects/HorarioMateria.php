<?php

namespace Siiau\ApiClient\Objects;

use Siiau\ApiClient\Collections\DiaCollection;

final class HorarioMateria
{
    public function __construct(
        public readonly string $hora,
        public readonly string $edificio,
        public readonly string $aula,
        public readonly ?DiaCollection $dias = null,
    ) {}
}
