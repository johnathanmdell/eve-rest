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

    /**
     * @param int $character_id
     * @return string
     */
    public function getCharacterNames($character_id)
    {
        return $this->request('GET', $this->buildResourceUri() .
            'names/?character_ids=' . implode(',', func_get_args()));
    }

    /**
     * @param int $character_id
     * @return string
     */
    public function getCharacterCorporationHistory($character_id)
    {
        return $this->request('GET', $this->buildResourceUri($character_id) . 'corporationhistory/');
    }

    /**
     * @param int $from_character_id
     * @param int $to_character_id
     * @return string
     */
    public function getCharacterCspa($from_character_id, $to_character_id)
    {
        return $this->request('POST', $this->buildResourceUri($from_character_id) . 'cspa/', [
            'characters' => array_slice(func_get_args(), 1)
        ]);
    }
}