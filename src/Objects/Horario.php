<?php

namespace Siiau\ApiClient\Objects;

final class Horario
{
    public function __construct(
        public readonly array $materias,
    ) {}
}
