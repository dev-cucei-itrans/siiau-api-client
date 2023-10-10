<?php

namespace Siiau\ApiClient\Exceptions;

use RuntimeException;
use Saloon\Http\{Request, Response};
use Throwable;

class InvalidCredentialsException extends RuntimeException
{
    public function __construct(
        public readonly Request $request,
        public readonly Response $response,
        string $message = 'The provided credentials are invalid.',
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
