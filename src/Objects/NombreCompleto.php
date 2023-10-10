<?php

namespace Siiau\ApiClient\Objects;

class NombreCompleto
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $apellido,
    ) {}
}
