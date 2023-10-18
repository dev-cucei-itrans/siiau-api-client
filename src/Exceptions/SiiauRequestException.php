<?php

namespace Siiau\ApiClient\Exceptions;

use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use Throwable;

class SiiauRequestException extends RequestException
{
    /**
     * Crea una nueva excepción apartir de la respuesta y opcionalmente el sender.
     */
    final public static function fromResponse(
        Response $response,
        ?Throwable $senderException = null
    ): static {
        return new static(
            response: $response,
            previous: $senderException,
        );
    }
}
