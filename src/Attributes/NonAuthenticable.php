<?php

namespace Siiau\ApiClient\Attributes;

use Attribute;
use ReflectionClass;
use ReflectionException;

/**
 * Mark a request as non-authenticable.
 */
#[Attribute(Attribute::TARGET_CLASS)]
final class NonAuthenticable
{
    /**
     * Check if an object or a class is marked as non-authenticable.
     *
     * @param object|class-string $objectOrClass
     * @throws ReflectionException if the class does not exist.
     */
    public static function belongsTo(object|string $objectOrClass): bool
    {
        $reflectionClass = new ReflectionClass($objectOrClass);

        $attributes = $reflectionClass->getAttributes(self::class);

        return isset($attributes[0]);
    }
}
