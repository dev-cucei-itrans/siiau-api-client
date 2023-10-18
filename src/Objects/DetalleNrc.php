<?php

namespace Siiau\ApiClient\Objects;

use Siiau\ApiClient\Collections\{HorarioCollection, ProfesorCollection};

final class DetalleNrc
{
    public function __construct(
        public readonly string  $cupo,
        public readonly string  $disponibilidad,
        public readonly HorarioCollection   $horario,
        public readonly ProfesorCollection   $profesor,
        public readonly Periodo $periodo,
    ) {}
}
