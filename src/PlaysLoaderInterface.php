<?php

namespace JanWennrich\BoardGames;

interface PlaysLoaderInterface
{
    /**
     * @return Play[]
     */
    public function getForUser(string $bggUsername): array;
}
