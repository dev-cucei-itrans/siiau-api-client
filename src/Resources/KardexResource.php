<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\BaseResource;
use Siiau\ApiClient\Objects\{Error, Kardex};
use Siiau\ApiClient\Requests\{KardexRequest};

final class KardexResource extends BaseResource
{
    public function encontrarDeAlumno(string $codigo, string $carrera): Kardex|Error|null
    {
        return $this->connector->send(new KardexRequest(codigo: $codigo, carrera: $carrera))->dto();
    }
}
