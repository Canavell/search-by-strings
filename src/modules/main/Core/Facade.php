<?php

namespace Main\Core;

use Main\File\Model\DescriptorGetter;
use Main\File\Model\StringIterator;
use Main\Search\Entity\BaseResult;
use Main\Search\Entity\Collection;
use Main\Search\Model\ISearch;

class Facade
{
    /**
     * @var ISearch
     */
    protected $searchEngine;

    /**
     * @var StringIterator
     */
    protected $stringIterator;

    protected $resultCollection;

    protected $descriptorGetter;

    public function __construct(ISearch $searchEngine, string $pathToFile, array $config)
    {
        $this->searchEngine = $searchEngine;
        $this->stringIterator = new StringIterator();
        $this->descriptorGetter = new DescriptorGetter($pathToFile, $config);
        $this->resultCollection = new Collection();

    }

    public function process(): Collection
    {
        // set descriptor
        $this->stringIterator->setDescriptor($this->descriptorGetter->getDescriptor());

        // gets string by string
        while ($string = $this->stringIterator->nextString()) {

            // get search's result
            $result = $this->searchEngine->search(
                $string, $this->stringIterator->getLine(),
                $this->searchEngine->getSearchString()
            );

            // checks if result should be added into result collection
            $this->putResultIntoCollection($result);
        }

        // removing file and close descriptor
        $this->descriptorGetter->closeDescriptor();

        // returning result collection
        return $this->resultCollection;
    }

    protected function putResultIntoCollection(BaseResult $result)
    {
        // if line exists (something was found) then we will add result into collection
        if($result->getLine() !== false){
            $this->resultCollection[] = $result;
        }
    }
}