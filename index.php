<?php
require_once 'vendor/autoload.php';

// initialize search engine
$searchEngine = new \Main\Search\Model\FindSubstring();
$searchEngine->setSearchString('and');


$builder = new \Main\Core\Builder($searchEngine, realpath(__DIR__ . '/data/sample.txt'));
$collectionResult = $builder->process();