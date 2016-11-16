<?php
namespace EveRest;

use EveRest\Resource\Resource;
use ReflectionClass;

class EveRestFactory
{
    /**
     * @param string $resource
     * @return Resource
     */
    public static function makeFactory($resource)
    {
        return (new ReflectionClass('EveRest\\Resource\\' . ucfirst($resource)))
            ->newInstance(array_slice(func_get_args(), 2));
    }
}