<?php
namespace EveRest;

use EveRest\Resource\Resource;
use ReflectionClass;

class EveRestFactory
{
    /**
     * @param string $resource
     * @param EveRest $eveRest
     * @return Resource
     */
    public static function makeFactory($resource, EveRest $eveRest)
    {
        return (new ReflectionClass('EveRest\\Resource\\' . ucfirst($resource)))
            ->newInstance($eveRest, array_slice(func_get_args(), 2));
    }
}