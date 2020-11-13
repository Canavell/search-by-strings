<?php


namespace Main\Search\Model;


use Main\Search\Entity\Result;

abstract class BaseSearch implements ISearch
{
    protected $searchString;

    public function search(string $string, int $line, string $searchValue): Result
    {
        $result = new Result();

        return $result;
    }

    public function setSearchString(string $string)
    {
        $this->searchString = $string;
    }

    public function getSearchString(): string
    {
        return $this->searchString;
    }
}