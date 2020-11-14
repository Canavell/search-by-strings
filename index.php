<?php
require_once 'vendor/autoload.php';

// initialize search engine
$searchEngine = new \Main\Search\Model\FindSubstring();
$searchEngine->setSearchString('all');

// config
$config = include 'src/config/main.php';

// search in url
$filePath = 'http://stackoverflow.com/';
$facade = new \Main\Core\Facade($searchEngine, $filePath, $config);
$collectionResult = $facade->process();
var_dump($collectionResult);



$searchEngine = new \Main\Search\Model\SearchByHash();
$searchString = "When thou art at thy table with thy friends,
";
$searchEngine->setSearchString($searchString);
$facade = new \Main\Core\Facade($searchEngine, $testPath, $config);
$collectionResult = $facade->process();
var_dump($collectionResult);

