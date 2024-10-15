<?php

namespace JanWennrich\BoardGames\Test\Stub;

use JanWennrich\BoardGames\PlayedBoardgamesLoaderInterface;

class PlayedBoardgamesLoaderStub implements PlayedBoardgamesLoaderInterface
{
    public function getForUser(string $bggUsername): array
    {
        return unserialize(file_get_contents(__DIR__ . '/../SerializedData/boardgames-played.serialized.txt'));
    }
}
