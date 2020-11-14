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
$testPath = 'data/sample.data';
file_put_contents($testPath, $string);
$facade = new \Main\Core\Facade($searchEngine, $testPath, $config);
$collectionResult = $facade->process();
var_dump($collectionResult);


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
$testPath = 'data/sample.data';
file_put_contents($testPath, $string);
$searchEngine = new \Main\Search\Model\SearchByHash();
$searchString = "When thou art at thy table with thy friends,
";
$searchEngine->setSearchString($searchString);
$facade = new \Main\Core\Facade($searchEngine, $testPath, $config);
$collectionResult = $facade->process();
var_dump($collectionResult);

