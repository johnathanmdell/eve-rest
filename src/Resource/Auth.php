<?php
namespace EveRest\Resource;

final class Auth extends Resource
{
    /**
     * @var string
     */
    protected $base_uri = 'https://login.eveonline.com/oauth/';

    /**
     * @param string $access_token
     * @return string
     */
    public function verifyToken($access_token)
    {
        return $this->request('GET', $this->buildResourceUri() . '/verify/', null, [
            'Authorization' => 'Bearer ' . $access_token
        ]);
    }

    /**
     * @param string $client_id
     * @param string $client_secret
     * @param string $refresh_token
     * @return string
     */
    public function refreshToken($client_id, $client_secret, $refresh_token)
    {
        return $this->request('POST', $this->buildResourceUri() .
            '/token/?grant_type=refresh_token&refresh_token=' . $refresh_token, null, [
            'Authorization' => 'Basic ' . base64_encode($client_id . ':' . $client_secret)
        ]);
    }
}