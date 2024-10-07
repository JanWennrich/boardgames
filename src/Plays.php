<?php

namespace JanWennrich\BoardGames;

use Nataniel\BoardGameGeek\Client;
use Nataniel\BoardGameGeek\Play;

class Plays
{
    public function __construct(private Client $bggApiClient)
    {
    }

    /**
     * @return Play[]
     *
     * @throws \Nataniel\BoardGameGeek\Exception
     */
    public function getPlays(string $bggUsername): array
    {
        return $this->bggApiClient->getPlays(['username' => $bggUsername]);
    }
}
