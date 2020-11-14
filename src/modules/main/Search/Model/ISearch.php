<?php


namespace Main\Search\Model;

use Main\Search\Entity\BaseResult;

interface ISearch
{
    public function search(string $string, int $line, string $searchValue): BaseResult;

    public function setSearchString(string $string);

    public function getSearchString(): string;
}