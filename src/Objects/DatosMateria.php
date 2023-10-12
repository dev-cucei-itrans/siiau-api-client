<?php

namespace Siiau\ApiClient\Objects;

final class DatosMateria
{
    public function __construct(
        public readonly string $nrc,
        public readonly string $clave,
        public readonly ?string $seccion,
        public readonly string $descripcion,
        public readonly string $creditos,
        public readonly ?array $horarioMateria
    ) {}
}
