<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Enums\Genero;
use Siiau\ApiClient\Objects\{Domicilio, Empresa, Nacimiento, Nombre, Usuario};

final class GetUsuarioRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $codigo,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/datos-usuario';
    }

    protected function defaultBody(): array
    {
        return [
            'codigo' => $this->codigo,
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): Usuario
    {
        $data = $response->json();

        return new Usuario(
            estadoCivil: $data['edo_civil'],
            empresa: new Empresa(
                nombre: $data['nom_empresa'],
                giro: $data['giro_empresa'],
                telefono: $data['tel_empresa'],
            ),
            domicilio: new Domicilio(
                localidad: $data['localidad'],
                calle: $data['domicilio'],
                colonia: $data['colonia'],
                noInterior: $data['no_interior'],
                noExterior: $data['no_exterior'],
            ),
            telefono: $data['telefono'],
            imss: $data['imss'],
            rfc: $data['rfc'],
            tipoSangre: $data['tipo_sangre'],
            codigo: $data['codigo'],
            nombre: new Nombre(
                nombres: $data['nombre'],
                apellidos: $data['ap_paterno'] . ' ' . $data['ap_materno'],
            ),
            genero: Genero::from($data['genero']),
            email: $data['email'],
            migratoria: $data['migratoria'],
            curp: $data['curp'],
            nacimiento: new Nacimiento(
                localidad: $data['loc_nac'],
                fecha: $data['fech_nac'],
                pais: $data['pais_nac'],
            ),
            nacionalidad: $data['nacionalidad'],
            pidm: $data['pidm'],
        );
    }
}
