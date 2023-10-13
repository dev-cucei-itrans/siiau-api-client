<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\BaseResource;
use Siiau\ApiClient\Objects\{Alumno, Error};
use Siiau\ApiClient\Requests\GetAlumnoRequest;

final class AlumnoResource extends BaseResource
{
    public function obtener(string $codigo): Alumno|Error|null
    {
        return $this->connector->send(new GetAlumnoRequest($codigo))->dto();
    }
}
