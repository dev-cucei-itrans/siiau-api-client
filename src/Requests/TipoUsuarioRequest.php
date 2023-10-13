<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Error, Estatus, TipoUsuario};

final class TipoUsuarioRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $codigo,
        private readonly string $password,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/tipo-usuario';
    }

    protected function defaultBody(): array
    {
        return [
            'codigo' => $this->codigo,
            'password' => $this->password,
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): TipoUsuario|Error
    {
        if($response->failed()) {
            return new Error($response->json('error'));
        }

        $data = $response->json();

        return new TipoUsuario(tipo: $data['tipoUsuario'], estatus: new Estatus(descripcion: $data['estatus']));
    }
}
