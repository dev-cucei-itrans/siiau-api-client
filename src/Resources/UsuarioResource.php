<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\{BaseResource, Response};
use Siiau\ApiClient\Objects\Error;
use Siiau\ApiClient\Objects\TipoUsuario;
use Siiau\ApiClient\Objects\Usuario;
use Siiau\ApiClient\Requests\{GetUsuarioRequest, TipoUsuarioRequest, ValidarCredencialesRequest};
use Throwable;

final class UsuarioResource extends BaseResource
{
    public function obtener(string $codigo): Usuario|Error|null
    {
        return $this->connector->send(new GetUsuarioRequest(codigo: $codigo))->dto();
    }

    /**
     * @throws ReflectionException
     * @throws Throwable
     */
    public function validar(string $codigo, string $password): bool|Error|null
    {
        return $this->connector->send(new ValidarCredencialesRequest(codigo: $codigo, password: $password))->dto();
    }

    public function tipo(string $codigo, string $password): TipoUsuario|Error|null
    {
        return $this->connector->send(new TipoUsuarioRequest(codigo: $codigo, password: $password))->dto();
    }
}
