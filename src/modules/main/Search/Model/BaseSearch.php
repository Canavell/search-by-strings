<?php

namespace Main\Search\Model;


abstract class BaseSearch implements ISearch
{
    protected $searchString;

    public function setSearchString(string $string)
    {
        $this->searchString = $string;
    }

    public function getSearchString(): string
    {
        return $this->searchString;
    }
}