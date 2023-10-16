<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\{BaseResource, Response};
use Siiau\ApiClient\Objects\DetalleNrc;
use Siiau\ApiClient\Objects\Error;
use Siiau\ApiClient\Objects\TipoUsuario;
use Siiau\ApiClient\Objects\Usuario;
use Siiau\ApiClient\Requests\{BuscarNrcRequest, DetalleNrcRequest, GetCarrerasCentroRequest};

final class GeneralResource extends BaseResource
{ 
    public function carreras(string $siglas): array|Error|null
    {
        return $this->connector->send(new GetCarrerasCentroRequest(siglas: $siglas))->dto();
    }

    public function buscarNrc(string $claveMateria, string $seccion, string $ciclo): String|Error|null
    {
        return $this->connector->send(new BuscarNrcRequest(claveMateria: $claveMateria, seccion: $seccion, ciclo: $ciclo))->dto();
    }

    public function detalleNrc(string $nrc, string $ciclo): DetalleNrc|Error|null
    {
        return $this->connector->send(new DetalleNrcRequest(nrc: $nrc, ciclo: $ciclo))->dto();
    }
}
