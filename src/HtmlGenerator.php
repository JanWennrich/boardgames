<?php

namespace JanWennrich\BoardGames;

use Twig\Environment;

final readonly class HtmlGenerator
{
    public function __construct(
        private Environment $twig
    ) {
    }

    public function generateHtml(BoardgameCollection $boardgamesOwned, PlayCollection $boardgamesPlayed): string
    {
        $ownedBoardgamesGroupedByFirstLetter = [];

        foreach ($boardgamesOwned as $ownedBoardgame) {
            $ownedBoardgamesGroupedByFirstLetter[mb_strtolower($ownedBoardgame->title[0])][] = $ownedBoardgame;
        }

        $playsGroupedByDate = [];

        foreach ($boardgamesPlayed as $play) {
            $playsGroupedByDate[$play->playDateTime->format('d.m.y')][] = $play->boardgame;
        }

        $params = [
            'playsGroupedByDate' => $playsGroupedByDate,
            'ownedBoardgamesGroupedByFirstLetter' => $ownedBoardgamesGroupedByFirstLetter
        ];

        return $this->twig->render('page.twig', $params);
    }
}
