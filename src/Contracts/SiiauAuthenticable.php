<?php

namespace Siiau\ApiClient\Contracts;

interface SiiauAuthenticable
{
    /**
     * Obtiene el código del usuario en SIIAU.
     */
    public function getCodigoSiiau(): ?string;
}
