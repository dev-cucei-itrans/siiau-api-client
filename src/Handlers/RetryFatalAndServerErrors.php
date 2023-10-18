<?php

namespace Siiau\ApiClient\Handlers;

use Saloon\Exceptions\Request\{FatalRequestException, RequestException};

/**
 * Handler that only retry fatal request exceptions and server errors.
 */
final class RetryFatalAndServerErrors
{
    public function __invoke(FatalRequestException|RequestException $exception): bool
    {
        return $exception instanceof FatalRequestException
            || $exception->getResponse()->serverError();
    }
}
