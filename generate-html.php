<?php

use JanWennrich\BoardGames\HtmlGenerator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once "vendor/autoload.php";

$diContainer = new \DI\Container([
    'bgg.username' => \DI\env('BGG_USERNAME'),
    Environment::class => \DI\factory(function () {
        return new Environment(new FilesystemLoader(__DIR__ . '/templates'));
    }),
]);

$bggUsername = $diContainer->get('bgg.username');

$html = $diContainer->get(HtmlGenerator::class)->generateHtml($bggUsername);

echo $html;
