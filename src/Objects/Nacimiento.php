<?php

namespace Siiau\ApiClient\Objects;

class Nacimiento
{
    public function __construct(
        public readonly string $localidadNacimiento,
        public readonly string $fechaNacimiento,
        public readonly string $paisNacimiento,
    ) {}
}
