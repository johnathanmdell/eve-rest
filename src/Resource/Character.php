<?php
namespace EveRest\Resource;

final class Character extends Resource
{
    /**
     * @var string
     */
    protected $base_uri = 'https://esi.tech.ccp.is/latest/characters/';

    /**
     * @param int $character_id
     * @return string
     */
    public function getCharacter($character_id)
    {
        return $this->request('GET', $this->buildResourceUri($character_id));
    }
}