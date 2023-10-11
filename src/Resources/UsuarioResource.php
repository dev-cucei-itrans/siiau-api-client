<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Siiau\ApiClient\Requests\GetUsuarioRequest;
use Siiau\ApiClient\Requests\ValidarCredencialesRequest;

class UsuarioResource extends BaseResource
{
    public function obtener(String $codigo): Response
    {
        return $this->connector->send(new GetUsuarioRequest($codigo));
    }

    public function validar(String $codigo, String $password): Response
    {
        return $this->connector->send(new ValidarCredencialesRequest($codigo, $password));
    }
}
