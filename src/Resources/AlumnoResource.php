<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\{BaseResource, Response};
use ReflectionException;
use Siiau\ApiClient\Objects\{Alumno, Error};
use Siiau\ApiClient\Requests\GetAlumnoRequest;
use Throwable;

final class AlumnoResource extends BaseResource
{
    /**
     * @throws ReflectionException
     * @throws Throwable
     */
    public function obtener(string $codigo): Alumno|Error
    {
        return $this->connector->send(new GetAlumnoRequest($codigo))->dto();
    }
}
