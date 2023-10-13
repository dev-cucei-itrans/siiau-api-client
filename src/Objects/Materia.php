<?php

namespace Siiau\ApiClient\Objects;

final class Materia
{
    public function __construct(
        public readonly string $nrc,
        public readonly string $clave,
        public readonly ?string $descripcion = null,
        public readonly ?string $creditos = null,
        public readonly ?string $seccion = null,
        public readonly ?array $horario = null,
        public readonly ?Fecha $fecha = null,
        public readonly ?EstatusMateria $estatus = null,
        public readonly ?Ciclo $ciclo = null,
        public readonly ?Profesor $profesor = null,
    ) {}
}
