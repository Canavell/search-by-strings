<?php


namespace Main\Search\Model;

use Main\Search\Entity\BaseResult;

/**
 * Interface ISearch
 * @package Main\Search\Model
 */
interface ISearch
{
    /**
     * @param string $string
     * @param int $line
     * @param string $searchValue
     * @return BaseResult
     */
    public function search(string $string, int $line, string $searchValue): BaseResult;

    /**
     * @param string $string
     * @return mixed
     */
    public function setSearchString(string $string);

    /**
     * @return string
     */
    public function getSearchString(): string;
}