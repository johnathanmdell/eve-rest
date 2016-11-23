<?php

use EveRest\EveRest;

include_once 'vendor/autoload.php';

$eveRest = new EveRest(
    'ea3fba5d4e5c4dbca59226328c8a4b71',
    'bGxCu3shjaSBhViD62edlbwFYb6S0TpP1kE4l3l9'
);

$characters = $eveRest->character()->getCharacterNames(95623216, 95747786, 96068141);

var_dump();