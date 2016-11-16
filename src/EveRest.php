<?php
namespace EveRest;

use EveRest\Resource\Resource;

class EveRest
{
    /**
     * @param string $name
     * @param array $arguments
     * @return Resource
     */
    public function __call($name, $arguments)
    {
        return EveRestFactory::makeFactory($name, $arguments);
    }
}