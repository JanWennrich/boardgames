<?php

namespace JanWennrich\BoardGames;

use Twig\Environment;

final readonly class HtmlGenerator
{
    public function __construct(private Environment $twig, private Plays $plays)
    {
    }

    public function generateHtml(string $bggUsername): string
    {
        $params = [
            'plays' => $this->plays->getPlays($bggUsername),
        ];
        return $this->twig->render('page.twig', $params);
    }
}
