<?php

namespace Siiau\ApiClient\Objects;

final class Ciclo
{
    public function __construct(
        public readonly string $id,
        public readonly string $descripcion
    ) {}
}
