<?php
require_once 'vendor/autoload.php';

// initialize search engine
$searchEngine = new \Main\Search\Model\FindSubstring();
$searchEngine->setSearchString('and');

// config
$config = include 'src/config/main.php';

$builder = new \Main\Core\Builder($searchEngine, realpath(__DIR__ . '/data/sample.txt'), $config);
$collectionResult = $builder->process();