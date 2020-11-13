<?php


namespace Main\Search\Model;


use Main\Search\Entity\Result;

interface ISearch
{
    public function search(string $string, int $line, string $searchValue): Result;

    public function setSearchString(string $string);

    public function getSearchString(): string;
}