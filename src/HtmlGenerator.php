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

        $ownedBoardgamesGroupedByFirstLetter = [];

        foreach ($ownedBoardgames as $ownedBoardgame) {
            $ownedBoardgamesGroupedByFirstLetter[mb_strtolower($ownedBoardgame->title[0])][] = $ownedBoardgame;
        }

        $plays = $this->plays->getForUser($bggUsername);

        $playsGroupedByDate = [];

        foreach ($plays as $play) {
            $playsGroupedByDate[$play->playDateTime->format('d.m.y')][] = $play->boardgame;
        }

        $params = [
            'playsGroupedByDate' => $playsGroupedByDate,
            'ownedBoardgamesGroupedByFirstLetter' => $ownedBoardgamesGroupedByFirstLetter
        ];

        return $this->twig->render('page.twig', $params);
    }
}
