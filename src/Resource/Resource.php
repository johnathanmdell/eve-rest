<?php
namespace EveRest\Resource;

use EveRest\EveRest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

abstract class Resource
{
    /**
     * @var Client
     */
    protected $guzzleClient;

    /**
     * @var string
     */
    protected $base_uri;

    /**
     * @var EveRest
     */
    protected $eveRest;

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @param EveRest $eveRest
     * @param array $arguments
     */
    public function __construct(EveRest $eveRest, array $arguments)
    {
        $this->guzzleClient = new Client();
        $this->eveRest = $eveRest;
        $this->arguments = $arguments;
    }

    /**
     * @param null|integer $resource_id
     * @return mixed
     */
    protected function buildResourceUri($resource_id = null)
    {
        $resource_id = is_null($resource_id) ? $resource_id : $resource_id . '/';

        return call_user_func_array('sprintf', array_merge([
            $this->base_uri . $resource_id], $this->arguments));
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array|null $body
     * @param array|null $headers
     * @return string
     */
    protected function request($method, $uri, array $body = null, array $headers = null)
    {
        try {
            return $this->parseResponse($this->guzzleClient->send(
                new Request($method, $uri, $this->getHeaders($headers), $this->getBody($body))));
        } catch(RequestException $exception) {
            return $this->parseExceptionResponse($exception);
        }
    }

    /**
     * @param ResponseInterface $response
     * @return string
     * @throws Exception
     */
    protected function parseResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param RequestException $exception
     * @return bool
     */
    protected function parseExceptionResponse(RequestException $exception)
    {
        if ($exception->hasResponse()) {
            var_dump($exception->getResponse()->getBody()->getContents());
            exit;
            return false;
        }
    }

    /**
     * @param array|null $body
     * @return array
     */
    protected function getBody(array $body = null)
    {
        return is_null($body) ? $body : json_encode($body);
    }

    /**
     * @param array|null $headers
     * @return array
     */
    protected function getHeaders(array $headers = null)
    {
        return is_null($headers) ? [] : $headers;
    }

    /**
     * @return EveRest
     */
    protected function getEveRest()
    {
        return $this->eveRest;
    }
}