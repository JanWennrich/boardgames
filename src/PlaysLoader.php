<?php

namespace JanWennrich\BoardGames;

use Nataniel\BoardGameGeek\Client;

class PlaysLoader implements PlaysLoaderInterface
{
    public function __construct(
        private readonly Client $bggApiClient,
        private readonly ThumbnailLoader $thumbnailLoader,
    ) {
    }

    /**
     * @return Play[]
     * @throws \Nataniel\BoardGameGeek\Exception|\DateMalformedStringException
     */
    public function getForUser(string $bggUsername): array
    {
        $bggPlays = $this->bggApiClient->getPlays(['username' => $bggUsername]);

        $bggPlayedGamesIds = array_map(fn($bggPlay) => $bggPlay->getObjectId(), $bggPlays);

        $playedGamesThumbnails = $this->thumbnailLoader->getForBggGameIds($bggPlayedGamesIds);

        return array_map(
            function (\Nataniel\BoardGameGeek\Play $bggPlay) use ($playedGamesThumbnails) {
                return new Play(
                    new Boardgame($bggPlay->getObjectName(), $playedGamesThumbnails[$bggPlay->getObjectId()]),
                    new \DateTimeImmutable($bggPlay->getDate()),
                );
            },
            $bggPlays,
        );
    }
}
