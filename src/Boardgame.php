<?php

namespace JanWennrich\BoardGames;

class Boardgame
{
    public function __construct(
        public string $title,
        public string $thumbnailUrl,
    ) {
    }
}
