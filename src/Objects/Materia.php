<?php

namespace Siiau\ApiClient\Objects;

final class Materia
{
    public function __construct(
        public readonly string $nrc,
        public readonly Fecha $fecha,
        public readonly ?string $calificacion,
        public readonly ?string $tipo,
        public readonly string $descripcion,
        public readonly ?Ciclo $ciclo,
        public readonly string $clave,
        public readonly ?string $seccion,
        public readonly string $creditos,
        public readonly ?Profesor $profesor,
        public readonly ?array $horarioMateria
    ) {}
}
