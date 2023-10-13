<?php

namespace Siiau\ApiClient\Objects;

final class Profesor
{
    public function __construct(
        public readonly string $codigo,
        public readonly ?string $nombre = null,
    ) {}
}
