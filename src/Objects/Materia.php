<?php

namespace Siiau\ApiClient\Objects;

use Siiau\ApiClient\Collections\HorarioCollection;

final class Materia
{
    public function __construct(
        public readonly string          $nrc,
        public readonly string          $clave,
        public readonly ?string         $descripcion = null,
        public readonly ?string         $creditos = null,
        public readonly ?string         $seccion = null,
        public readonly ?HorarioCollection $horario = null,
        public readonly ?Periodo        $periodo = null,
        public readonly ?Calificacion   $calificacion = null,
        public readonly ?Ciclo          $ciclo = null,
        public readonly ?Profesor       $profesor = null,
    ) {}
}
