<?php

namespace Siiau\ApiClient\Objects;

final class Kardex
{
    public function __construct(
        public readonly Creditos $creditos,
        public readonly string $certificado,
        public readonly string $promedio,
        public readonly array $materias,
        public readonly array $creditosArea,
    ) {}
}
