<?php

namespace JanWennrich\BoardGames;

interface OwnedBoardgamesLoaderInterface
{
    /**
     * @return Boardgame[]
     */
    public function getForUser(string $bggUsername): array;
}
