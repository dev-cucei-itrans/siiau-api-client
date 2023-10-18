<?php

namespace Siiau\ApiClient\Objects;

final class DetalleNrc
{
    public function __construct(
        public readonly string  $cupo,
        public readonly string  $disponibilidad,
        public readonly array   $horario,
        public readonly array   $profesor,
        public readonly Periodo $periodo,
    ) {}
}
