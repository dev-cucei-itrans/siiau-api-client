<?php

namespace Siiau\ApiClient\Objects;

final class Alumno
{
    public function __construct(
        public readonly string $carrera,
        public readonly Nombre $nombre,
        public readonly string $codigo,
        public readonly string $situacion,
        public readonly Ciclo  $ultimoCiclo,
        public readonly string $campus,
    ) {}
}
