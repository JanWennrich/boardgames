<?php

namespace JanWennrich\BoardGames;

use Twig\Environment;

final readonly class HtmlGenerator
{
    public function __construct(
        private Environment $twig,
        private PlayedBoardgamesLoaderInterface $plays,
    ) {
    }

    public function generateHtml(string $bggUsername): string
    {
        $plays = $this->plays->getForUser($bggUsername);

        $playsGroupedByDate = [];

        foreach ($plays as $play) {
            $playsGroupedByDate[$play->playDateTime->format('c')][] = $play;
        }

        $params = [
            'playsGroupedByDate' => $playsGroupedByDate
        ];

        return $this->twig->render('page.twig', $params);
    }
}
