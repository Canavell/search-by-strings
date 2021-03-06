<?php 
class SearchEngineTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $config = false;
    protected $notFindString = '';

    protected function _before()
    {
        $this->config = include realpath(__DIR__ . '/../../') . '/src/config/main.php';
        $this->notFindString = uniqid() . uniqid() . "не находись никогда!";
    }

    protected function _after()
    {
        $this->config = false;
    }

    // tests
    public function testSuccessfulSearchInFileBySubstringPath()
    {
        $testPath = $this->createStubFilePath();

        // initialize search engine
        $searchEngine = new \Main\Search\Model\FindSubstring();
        $searchEngine->setSearchString('all');

        $facade = new \Main\Core\Facade($searchEngine, $testPath, $this->config);
        $collectionResult = $facade->process();

        $this->assertEquals(3, count($collectionResult));
    }

    public function testNotSuccessfulSearchInFileBySubstringPath()
    {
        $testPath = $this->createStubFilePath();

        // initialize search engine
        $searchEngine = new \Main\Search\Model\FindSubstring();
        $searchEngine->setSearchString($this->notFindString);

        $facade = new \Main\Core\Facade($searchEngine, $testPath, $this->config);
        $collectionResult = $facade->process();

        $this->assertEquals(0, count($collectionResult));
    }


    // tests
    public function testSuccessfulSearchInFileByHashPath()
    {
        $testPath = $this->createStubFilePath();

        // initialize search engine
        $searchEngine = new \Main\Search\Model\SearchByHash();
        $searchEngine->setSearchString("When thou art at thy table with thy friends,
");
        $facade = new \Main\Core\Facade($searchEngine, $testPath, $this->config);
        $collectionResult = $facade->process();

        $this->assertEquals(1, count($collectionResult));
    }

    // tests
    public function testNotSuccessfulSearchInFileByHashPath()
    {
        $testPath = $this->createStubFilePath();

        // initialize search engine
        $searchEngine = new \Main\Search\Model\SearchByHash();
        $searchEngine->setSearchString($this->notFindString);
        $facade = new \Main\Core\Facade($searchEngine, $testPath, $this->config);
        $collectionResult = $facade->process();

        $this->assertEquals(0, count($collectionResult));
    }



    // tests
    public function testSuccessfulSearchInURLBySubstringPath()
    {
        $testPath = $this->getTestURLProducesHTML();

        // initialize search engine
        $searchEngine = new \Main\Search\Model\FindSubstring();
        $searchEngine->setSearchString("DOCTYPE");
        $facade = new \Main\Core\Facade($searchEngine, $testPath, $this->config);
        $collectionResult = $facade->process();

        $this->assertEquals(1, count($collectionResult));
    }

    public function testNotSuccessfulSearchInURLBySubstringPath()
    {
        $testPath = $this->getTestURLProducesHTML();

        // initialize search engine
        $searchEngine = new \Main\Search\Model\FindSubstring();
        $searchEngine->setSearchString($this->notFindString);
        $facade = new \Main\Core\Facade($searchEngine, $testPath, $this->config);
        $collectionResult = $facade->process();

        $this->assertEquals(0, count($collectionResult));
    }


    public function testMimeTypeError()
    {
        $testPath = $this->getTestURLProducesPNG();

        // initialize search engine
        $searchEngine = new \Main\Search\Model\FindSubstring();
        $searchEngine->setSearchString($this->notFindString);
        try {
            $facade = new \Main\Core\Facade($searchEngine, $testPath, $this->config);
            $facade->process();
        } catch (\Main\Exception\MimeTypeException $e) {
            $this->assertInstanceOf(\Main\Exception\ISearchEngineExceptions::class, $e);
        }
    }

    public function testMimeTypeWithoutConfig()
    {
        $testPath = $this->getTestURLProducesPNG();

        // initialize search engine
        $searchEngine = new \Main\Search\Model\FindSubstring();
        $searchEngine->setSearchString($this->notFindString);
        $facade = new \Main\Core\Facade($searchEngine, $testPath, []);
        $collectionResult = $facade->process();


        $this->assertEquals(0, count($collectionResult));
    }

    public function testFileNotFoundError()
    {
        $testPath = 'there-is-no-file';

        // initialize search engine
        $searchEngine = new \Main\Search\Model\FindSubstring();
        $searchEngine->setSearchString($this->notFindString);
        try {
            $facade = new \Main\Core\Facade($searchEngine, $testPath, $this->config);
            $facade->process();
        } catch (\Main\Exception\FileNotFound $e) {
            $this->assertInstanceOf(\Main\Exception\ISearchEngineExceptions::class, $e);
        }
    }

    protected function getTestURLProducesPNG()
    {
        return 'https://contribute.geeksforgeeks.org/wp-content/uploads/gfg-40.png';
    }

    protected function getTestURLProducesHTML()
    {
        return 'http://stackoverflow.com/';
    }

    protected function createStubFilePath()
    {
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
        $testPath = realpath(__DIR__ . '/../../') . '/data/sample.data';
        file_put_contents($testPath, $string);
        return $testPath;
    }
}