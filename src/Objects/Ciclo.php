<?php

namespace Siiau\ApiClient\Objects;

class Ciclo
{
    public function __construct(
        public readonly string $id,
        public readonly string $descripcion
    ) {}
}
