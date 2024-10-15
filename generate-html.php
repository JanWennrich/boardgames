<?php

use JanWennrich\BoardGames\HtmlGenerator;
use JanWennrich\BoardGames\OwnedBoardgamesLoader;
use JanWennrich\BoardGames\OwnedBoardgamesLoaderInterface;
use JanWennrich\BoardGames\PlayedBoardgamesLoader;
use JanWennrich\BoardGames\PlayedBoardgamesLoaderInterface;
use JanWennrich\BoardGames\Test\Stub\OwnedBoardgamesLoaderStub;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once "vendor/autoload.php";

$diContainer = new \DI\Container([
    'bgg.username' => \DI\env('BGG_USERNAME'),
    Environment::class => \DI\factory(function () {
        return new Environment(new FilesystemLoader(__DIR__ . '/templates'));
    }),
    PlayedBoardgamesLoaderInterface::class => \DI\get(PlayedBoardgamesLoader::class),
    OwnedBoardgamesLoaderInterface::class => \DI\get(OwnedBoardgamesLoader::class),
]);

if (getenv('BGG_API') === 'mocked') {
    $diContainer->set(
        PlayedBoardgamesLoaderInterface::class,
        \DI\get(\JanWennrich\BoardGames\Test\Stub\PlayedBoardgamesLoader::class),
    );

    $diContainer->set(
        OwnedBoardgamesLoaderInterface::class,
        \DI\get(OwnedBoardgamesLoaderStub::class),
    );
}

$bggUsername = $diContainer->get('bgg.username');

$html = $diContainer->get(HtmlGenerator::class)->generateHtml($bggUsername);

echo $html;
