<?php

namespace JanWennrich\BoardGames;

use Nataniel\BoardGameGeek\Client;
use Nataniel\BoardGameGeek\CollectionItem;

class OwnedBoardgamesLoader implements OwnedBoardgamesLoaderInterface
{
    public function __construct(
        private readonly Client $bggApiClient,
    ) {
    }

    /**
     * @return Boardgame[]
     * @throws \Nataniel\BoardGameGeek\Exception
     */
    public function getForUser(string $bggUsername): array
    {
        $ownedBoardgames = $this->bggApiClient->getCollection([
            'username' => $bggUsername,
            'own' => 1,
        ]);

        return array_map(
            fn(CollectionItem $collectionItem) => new Boardgame(
                $collectionItem->getName(),
                $collectionItem->getThumbnail(),
            ),
            $ownedBoardgames,
        );
    }
}
