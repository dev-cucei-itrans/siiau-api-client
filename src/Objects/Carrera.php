<?php

namespace Siiau\ApiClient\Objects;

final class Carrera
{
    public function __construct(
        public readonly string $id,
        public readonly ?string $descripcion = null,
    ) {}
}
