<?php

namespace App\GameMessages;

abstract class GameMessage
{
    // Must return a unique key for the message
    abstract public function getKey(): string;

    // Optionally define what the message text is
    public function getMessage(): string
    {
        return '';
    }
}
