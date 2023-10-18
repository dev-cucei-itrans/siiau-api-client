<?php

namespace Siiau\ApiClient\Objects;

use Siiau\ApiClient\Collections\{CreditosAreaCollection, MateriaCollection};

final class Kardex
{
    public function __construct(
        public readonly Creditos $creditos,
        public readonly string $certificado,
        public readonly string $promedio,
        public readonly MateriaCollection $materias,
        public readonly CreditosAreaCollection $creditosArea,
    ) {}
}
