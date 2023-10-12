<?php

namespace Siiau\ApiClient\Objects;

final class Profesor
{
    public function __construct(
        public readonly string $nombreProfesor,
        public readonly string $codigoProfesor,
    ) {}
}
