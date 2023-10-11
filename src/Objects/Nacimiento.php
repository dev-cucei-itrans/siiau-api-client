<?php

namespace Siiau\ApiClient\Objects;

final class Nacimiento
{
    public function __construct(
        public readonly string $localidad,
        public readonly string $fecha,
        public readonly string $pais,
    ) {}
}
