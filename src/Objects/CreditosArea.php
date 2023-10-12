<?php

namespace Siiau\ApiClient\Objects;

final class CreditosArea
{
    public function __construct(
        public readonly Creditos $creditos,
        public readonly string $diferencia,
        public readonly string $area,
    ) {}
}
