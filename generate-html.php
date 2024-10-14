<?php

use JanWennrich\BoardGames\HtmlGenerator;
use JanWennrich\BoardGames\PlaysLoader;
use JanWennrich\BoardGames\PlaysLoaderInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once "vendor/autoload.php";

$diContainer = new \DI\Container([
    'bgg.username' => \DI\env('BGG_USERNAME'),
    Environment::class => \DI\factory(function () {
        return new Environment(new FilesystemLoader(__DIR__ . '/templates'));
    }),
    PlaysLoaderInterface::class => \DI\get(PlaysLoader::class),
]);

if (getenv('BGG_API') === 'mocked') {
    $diContainer->set(
        PlaysLoaderInterface::class,
        \DI\get(\JanWennrich\BoardGames\Test\Stub\PlaysLoader::class),
    );
}

$bggUsername = $diContainer->get('bgg.username');

$html = $diContainer->get(HtmlGenerator::class)->generateHtml($bggUsername);

echo $html;
