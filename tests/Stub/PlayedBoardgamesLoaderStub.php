<?php

namespace JanWennrich\BoardGames\Test\Stub;

use JanWennrich\BoardGames\PlayedBoardgamesLoaderInterface;

class PlayedBoardgamesLoader implements PlayedBoardgamesLoaderInterface
{
    public function getForUser(string $bggUsername): array
    {
        return unserialize(file_get_contents(__DIR__ . '/../SerializedData/boardgame-plays.php'));
    }
}
