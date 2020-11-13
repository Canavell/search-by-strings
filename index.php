<?php
require_once 'vendor/autoload.php';

// initialize search engine
$searchEngine = new \Main\Search\Model\FindSubstring();
$searchEngine->setSearchString('and');

// config
$config = include 'src/config/main.php';

// search in url
$filePath = 'http://stackoverflow.com/';
$builder = new \Main\Core\Builder($searchEngine, $filePath, $config);
$collectionResult = $builder->process();

// creating file stub
$string = "
When thou art at thy table with thy friends,
Merry in heart, and filled with swelling wine,
I'll come in midst of all thy pride and mirth,
Invisible to all men but thyself,
And whisper such a sad tale in thine ear
Shall make thee let the cup fall from thy hand,
And stand as mute and pale as death itself.
";
// search in file
$testPath = realpath(__DIR__ . '/data/sample.data');
file_put_contents($testPath, $string);
$builder = new \Main\Core\Builder($searchEngine, $testPath, $config);
$collectionResult = $builder->process();