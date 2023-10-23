<?php

namespace Siiau\ApiClient\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * Indica que el modelo guarda el codigo del usuario dentro de una columna del mimso nombre.
 *
 * @mixin Model
 */
trait HasCodigoSiiau
{
    final public function getCodigoSiiau(): ?string
    {
        return $this->getAttribute(key: 'codigo');
    }
}
