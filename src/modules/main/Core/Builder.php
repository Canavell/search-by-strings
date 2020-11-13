<?php

namespace Main\Core;

use Main\File\Model\StringIterator;
use Main\Search\Entity\Collection;
use Main\Search\Entity\Result;
use Main\Search\Model\ISearch;

class Builder
{
    /**
     * @var ISearch
     */
    protected $searchEngine;

    /**
     * @var StringIterator
     */
    protected $stringIterator;

    protected $collection;

    public function __construct(ISearch $searchEngine, string $pathToFile)
    {
        $this->searchEngine = $searchEngine;
        $this->stringIterator = new StringIterator($pathToFile);
        $this->collection = new Collection();
    }

    public function process(): Collection
    {
        // initialize string iterator
        $this->stringIterator->init();
        $line = 0;
        while ($string = $this->stringIterator->nextString()) {
            $result = $this->searchEngine->search($string, $this->stringIterator->getLine(), $this->searchEngine->getSearchString());
            $this->putResultIntoCollection($result);
        }

        return $this->collection;
    }

    protected function putResultIntoCollection(Result $result)
    {
        if($result->getLine() !== false && $result->getPosition() !== false){
            $this->collection[] = $result;
        }
    }

}