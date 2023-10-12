<?php

namespace Siiau\ApiClient\Objects;

final class Materia
{
    public function __construct(
        public readonly DatosMateria $datosMateria,
        public readonly Fecha $fecha,
        public readonly ?EstatusMateria $estatus,
        public readonly ?Ciclo $ciclo,
        public readonly ?Profesor $profesor,
    ) {}
}
