<?php

namespace Siiau\ApiClient\Resources;

use Saloon\Http\{BaseResource};
use Siiau\ApiClient\Objects\{Error, TipoUsuario, Usuario};
use Siiau\ApiClient\Requests\{GetUsuarioRequest, TipoUsuarioRequest, ValidarCredencialesRequest};
use ReflectionException;
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
    public function validar(string $codigo, string $password): bool|Error
    {
        return $this->connector->send(new ValidarCredencialesRequest(codigo: $codigo, password: $password))->dto();
    }

    public function tipo(string $codigo, string $password): TipoUsuario|Error|null
    {
        return $this->connector->send(new TipoUsuarioRequest(codigo: $codigo, password: $password))->dto();
    }
}
