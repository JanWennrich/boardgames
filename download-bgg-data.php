<?php

use Crell\Serde\SerdeCommon;
use JanWennrich\BoardGames\OwnedBoardgamesLoader;
use JanWennrich\BoardGames\PlayedBoardgamesLoader;

require_once __DIR__ . '/vendor/autoload.php';

$containerConfig = require_once __DIR__ . "/container-config.php";

$diContainer = new \DI\Container($containerConfig);

$bggUsername = $diContainer->get('bgg.username');

$playedBoardgames = $diContainer->get(PlayedBoardgamesLoader::class)->getForUser($bggUsername);
$playedBoardgamesSerialized = serialize($playedBoardgames);
$playedBoardgamesSerializationPath = $diContainer->get('serialization.path.boardgames.played');
file_put_contents($playedBoardgamesSerializationPath, $playedBoardgamesSerialized);

$ownedBoardgames = $diContainer->get(OwnedBoardgamesLoader::class)->getForUser($bggUsername);
$ownedBoardgamesSerialized = serialize($ownedBoardgames);
$ownedBoardgamesSerializationPath = $diContainer->get('serialization.path.boardgames.owned');
file_put_contents($ownedBoardgamesSerializationPath, $ownedBoardgamesSerialized);
