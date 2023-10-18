<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\BaseResource;
use Siiau\ApiClient\Objects\{Error};
use Siiau\ApiClient\Requests\{CarrerasAlumnoRequest, GetCarrerasCentroRequest};
use Siiau\ApiClient\Collections\{CarreraAlumnoCollection, CarreraCollection};

final class CarreraResource extends BaseResource
{
    public function todasDeAlumno(string $codigo): CarreraAlumnoCollection|Error|null
    {
        return $this->connector->send(new CarrerasAlumnoRequest(codigo: $codigo))->dto();
    }

    public function todasDeCentro(string $siglas): CarreraCollection|Error|null
    {
        return $this->connector->send(new GetCarrerasCentroRequest(siglas: $siglas))->dto();
    }
}
