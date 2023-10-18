<?php

namespace Siiau\ApiClient\Objects;

final class CarrerasAlumno
{
    public function __construct(
        public readonly Carrera $carrera,
        public readonly Ciclo $cicloAdmision,
        public readonly Ciclo $ultimoCiclo,
        public readonly Estatus $estatus,
        public readonly string $nivel,
        public readonly Universidad $universidad,
    ) {}
}
