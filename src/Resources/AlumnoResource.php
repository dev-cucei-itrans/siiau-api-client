<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\BaseResource;
use Siiau\ApiClient\Objects\{Alumno, Error, Horario, Kardex};
use Siiau\ApiClient\Requests\{CarrerasAlumnoRequest, GetAlumnoRequest, HorarioRequest, KardexRequest};
use Siiau\ApiClient\Collections\{CarreraAlumnoCollection, MateriaCollection};

final class AlumnoResource extends BaseResource
{
    public function obtener(string $codigo): Alumno|Error|null
    {
        return $this->connector->send(new GetAlumnoRequest(codigo: $codigo))->dto();
    }

    public function carreras(string $codigo): CarreraAlumnoCollection|Error|null
    {
        return $this->connector->send(new CarrerasAlumnoRequest(codigo: $codigo))->dto();
    }

    public function kardex(string $codigo, string $carrera): Kardex|Error|null
    {
        return $this->connector->send(new KardexRequest(codigo: $codigo, carrera: $carrera))->dto();
    }

    public function horario(string $codigo, string $ciclo): MateriaCollection|Error|null
    {
        return $this->connector->send(new HorarioRequest(codigo: $codigo, ciclo: $ciclo))->dto();
    }
}
