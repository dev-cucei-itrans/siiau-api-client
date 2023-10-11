<?php

namespace Siiau\ApiClient\Objects;

use Stringable;

final class Nombre implements Stringable
{
    public function __construct(
        public readonly string $nombres,
        public readonly string $apellidos,
    ) {}

    public function __toString(): string
    {
        return "$this->nombres $this->apellidos";
    }
}
