<?php

namespace JanWennrich\BoardGames\Test\Stub;

use JanWennrich\BoardGames\OwnedBoardgamesLoaderInterface;

class OwnedBoardgamesLoaderStub implements OwnedBoardgamesLoaderInterface
{
    public function getForUser(string $bggUsername): array
    {
        return unserialize(file_get_contents(__DIR__ . '/../SerializedData/boardgames-owned.serialized.txt'));
    }
}
