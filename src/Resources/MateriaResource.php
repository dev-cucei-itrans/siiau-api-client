<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\{BaseResource};
use Siiau\ApiClient\Collections\MateriaCollection;
use Siiau\ApiClient\Objects\{DetalleNrc, Error};
use Siiau\ApiClient\Requests\{BuscarNrcRequest, DetalleNrcRequest, HorarioRequest};

final class MateriaResource extends BaseResource
{
    public function todasDeAlumno(string $codigo, string $ciclo): MateriaCollection|Error|null
    {
        return $this->connector->send(new HorarioRequest(codigo: $codigo, ciclo: $ciclo))->dto();
    }

    public function nrc(string $claveMateria, string $seccion, string $ciclo): string|Error|null
    {
        return $this->connector->send(new BuscarNrcRequest(claveMateria: $claveMateria, seccion: $seccion, ciclo: $ciclo))->dto();
    }

    public function encontrar(string $nrc, string $ciclo): DetalleNrc|Error|null
    {
        return $this->connector->send(new DetalleNrcRequest(nrc: $nrc, ciclo: $ciclo))->dto();
    }
}
