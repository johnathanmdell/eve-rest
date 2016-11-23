<?php
namespace EveRest;

use EveRest\Resource\Resource;
use Exception;

class EveRest
{
    /**
     * @var null|string
     */
    private $client_id;

    /**
     * @var null|string
     */
    private $client_secret;

    /**
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct($client_id = null, $client_secret = null)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return Resource
     */
    public function __call($name, $arguments)
    {
        return EveRestFactory::makeFactory($name, $this, $arguments);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getClientId()
    {
        if (is_null($this->client_id)) {
            throw new Exception('Client id has not been set');
        }

        return $this->client_id;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getClientSecret()
    {
        if (is_null($this->client_secret)) {
            throw new Exception('Client secret has not been set');
        }

        return $this->client_secret;
    }
}