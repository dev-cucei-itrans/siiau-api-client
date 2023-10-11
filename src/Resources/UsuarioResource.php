<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Siiau\ApiClient\Requests\GetUsuarioRequest;

class UsuarioResource extends BaseResource
{
     public function obtener(String $codigo): Response
     {
         return $this->connector->send(new GetUsuarioRequest($codigo));
     }
}