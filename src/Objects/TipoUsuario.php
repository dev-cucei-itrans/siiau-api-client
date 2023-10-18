<?php

namespace Siiau\ApiClient\Objects;

final class TipoUsuario
{
    public function __construct(
        public readonly string $tipo,
        public readonly Estatus $estatus,
    ) {}
}
