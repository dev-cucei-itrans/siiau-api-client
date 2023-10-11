<?php

namespace Siiau\ApiClient\Resources;

use ReflectionException;
use Saloon\Http\{BaseResource, Response};
use Siiau\ApiClient\Requests\{GetUsuarioRequest, ValidarCredencialesRequest};
use Throwable;

final class UsuarioResource extends BaseResource
{
    /**
     * @throws ReflectionException
     * @throws Throwable
     */
    public function obtener(string $codigo): Response
    {
        return $this->connector->send(new GetUsuarioRequest($codigo));
    }

    /**
     * @throws ReflectionException
     * @throws Throwable
     */
    public function validar(string $codigo, string $password): Response
    {
        return $this->connector->send(new ValidarCredencialesRequest($codigo, $password));
    }
}
