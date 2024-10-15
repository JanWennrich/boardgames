<?php

namespace JanWennrich\BoardGames;

interface PlayedBoardgamesLoaderInterface
{
    /**
     * @return Play[]
     */
    public function getForUser(string $bggUsername): array;
}
