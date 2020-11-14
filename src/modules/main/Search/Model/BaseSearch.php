<?php

namespace Main\Search\Model;


/**
 * Class BaseSearch
 * @package Main\Search\Model
 */
abstract class BaseSearch implements ISearch
{
    /**
     * @var
     */
    protected $searchString;

    /**
     * @param string $string
     * @return mixed|void
     */
    public function setSearchString(string $string)
    {
        $this->searchString = $string;
    }

    /**
     * @return string
     */
    public function getSearchString(): string
    {
        return $this->searchString;
    }
}