<?php

namespace Siiau\ApiClient\Objects;

final class Domicilio
{
    public function __construct(
        public readonly string $localidad,
        public readonly string $calle,
        public readonly string $colonia,
        public readonly string $noInterior,
        public readonly string $noExterior,
    ) {}
}
