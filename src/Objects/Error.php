<?php

namespace Siiau\ApiClient\Objects;

final class Error
{
    public function __construct(
        public readonly string $message,
    ) {}
}
