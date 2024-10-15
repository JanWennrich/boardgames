<?php

namespace JanWennrich\BoardGames;

use Twig\Environment;

final readonly class HtmlGenerator
{
    public function __construct(
        private Environment $twig,
        private PlayedBoardgamesLoaderInterface $plays,
        private OwnedBoardgamesLoaderInterface $ownedBoardgamesLoader
    ) {
    }

    public function generateHtml(string $bggUsername): string
    {
        $ownedBoardgames = $this->ownedBoardgamesLoader->getForUser($bggUsername);

        $plays = $this->plays->getForUser($bggUsername);

        $playsGroupedByDate = [];

        foreach ($plays as $play) {
            $playsGroupedByDate[$play->playDateTime->format('c')][] = $play;
        }

        $params = [
            'playsGroupedByDate' => $playsGroupedByDate,
            'ownedBoardgames' => $ownedBoardgames
        ];

        return $this->twig->render('page.twig', $params);
    }
}
