<?php

namespace Siiau\ApiClient\Objects;

use Siiau\ApiClient\Enums\Genero;

class Usuario
{
    public function __construct(
        public readonly string $estadoCivil,
        public readonly Empresa $empresa,
        public readonly Domicilio $domicilio,
        public readonly string $telefono,
        public readonly string $imss,
        public readonly string $rfc,
        public readonly string $tipoSangre,
        public readonly string $codigo,
        public readonly NombreCompleto $nombreCompleto,
        public readonly Genero $genero,
        public readonly string $email,
        public readonly string $migratoria,
        public readonly string $curp,
        public readonly Nacimiento $nacimiento,
        public readonly string $nacionalidad,
        public readonly string $pidm,
    ) {}
}
