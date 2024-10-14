<?php

namespace JanWennrich\BoardGames\Test\Stub;

use JanWennrich\BoardGames\PlaysLoaderInterface;

class PlaysLoader implements PlaysLoaderInterface
{
    public function getForUser(string $bggUsername): array
    {
        return unserialize(file_get_contents(__DIR__ . '/../SerializedData/plays.php'));
    }
}
