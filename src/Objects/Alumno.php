<?php

namespace Siiau\ApiClient\Objects;

class Alumno
{
    public function __construct(
        public readonly string $carrera,
        public readonly NombreCompleto $nombre,
        public readonly string $codigo,
        public readonly string $situacion,
        public readonly Ciclo $ultimoCiclo,
        public readonly string $campus,
    ) {}
}
