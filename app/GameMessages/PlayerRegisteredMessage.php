<?php

namespace App\GameMessages;

use App\Contracts\GameMessage;

class PlayerRegisteredMessage extends GameMessage
{
    public function getKey(): string
    {
        return 'player.registered';
    }

    public function getMessage(): string
    {
        return 'You have successfully registered to Dreamforge! Remember this is a alpha-beta mmo!';
    }
}
