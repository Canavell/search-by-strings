<?php


namespace Main\Search\Model;

use Main\Search\Entity\AbstractResult;

interface ISearch
{
    public function search(string $string, int $line, string $searchValue): AbstractResult;

    public function setSearchString(string $string);

    public function getSearchString(): string;
}