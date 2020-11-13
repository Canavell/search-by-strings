<?php

namespace Main\Core;

use Main\File\Model\DescriptorGetter;
use Main\File\Model\StringIterator;
use Main\Search\Entity\AbstractResult;
use Main\Search\Entity\Collection;
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

    protected $descriptorGetter;

    public function __construct(ISearch $searchEngine, string $pathToFile, array $config)
    {
        $this->searchEngine = $searchEngine;
        $this->stringIterator = new StringIterator();
        $this->descriptorGetter = new DescriptorGetter($pathToFile, $config);

        $this->collection = new Collection();

    }

    public function process(): Collection
    {
        // set descriptor
        $this->stringIterator->setDescriptor($this->descriptorGetter->getDescriptor());

        // initialize string iterator
        while ($string = $this->stringIterator->nextString()) {
            $result = $this->searchEngine->search($string, $this->stringIterator->getLine(), $this->searchEngine->getSearchString());
            $this->putResultIntoCollection($result);
        }

        $this->descriptorGetter->closeDescriptor();
        return $this->collection;
    }

    protected function putResultIntoCollection(AbstractResult $result)
    {
        if($result->getStatus() !== false){
            $this->collection[] = $result;
        }
    }
}