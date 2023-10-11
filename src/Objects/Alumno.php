<?php

namespace Siiau\ApiClient\Objects;

final class Alumno
{
    public function __construct(
        public readonly Carrera $carrera,
        public readonly Nombre $nombre,
        public readonly string $codigo,
        public readonly Estatus $estatus,
        public readonly Ciclo  $ultimoCiclo,
        public readonly Universidad $campus,
    ) {}
}
