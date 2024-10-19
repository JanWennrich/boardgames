<?php

use Crell\Serde\SerdeCommon;
use JanWennrich\BoardGames\HtmlGenerator;

require_once __DIR__ . '/vendor/autoload.php';

$containerConfig = require_once __DIR__ . "/container-config.php";

$diContainer = new \DI\Container($containerConfig);

$boardgamesOwnerSerializedPath = $diContainer->get('serialization.path.boardgames.owned');
$boardgamesOwnedSerialized = file_get_contents($boardgamesOwnerSerializedPath);
$boardgamesOwned = unserialize($boardgamesOwnedSerialized ?: throw new Exception("Could not read owned boardgames from '$boardgamesOwnerSerializedPath'"));

$boardgamesPlayedSerializedPath = $diContainer->get('serialization.path.boardgames.played');
$boardgamesPlayedSerialized = file_get_contents($boardgamesPlayedSerializedPath);
$boardgamesPlayed = unserialize($boardgamesPlayedSerialized ?: throw new Exception("Could not read played boardgames from '$boardgamesPlayedSerializedPath'"));

$htmlGenerator = $diContainer->get(HtmlGenerator::class);
$html = $htmlGenerator->generateHtml($boardgamesOwned, $boardgamesPlayed);

file_put_contents(__DIR__ . '/build/index.html', $html);
