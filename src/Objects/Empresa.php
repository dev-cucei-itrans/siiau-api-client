<?php

namespace Siiau\ApiClient\Objects;

final class Empresa
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $giro,
        public readonly string $telefono,
    ) {}
}
