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
     * @throws \Nataniel\BoardGameGeek\Exception
     */
    public function getForUser(string $bggUsername): BoardgameCollection
    {
        $ownedBoardgames = $this->bggApiClient->getCollection([
            'username' => $bggUsername,
            'own' => 1,
        ]);

        $ownedBoardgames = array_map(
            fn(CollectionItem $collectionItem) => new Boardgame(
                $collectionItem->getName(),
                $collectionItem->getThumbnail(),
                $collectionItem->getObjectId()
            ),
            $ownedBoardgames,
        );

        return new BoardgameCollection($ownedBoardgames);
    }
}
