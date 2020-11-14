<?php


namespace Main\Search\Model;


use Main\Search\Entity\BaseResult;

/**
 * Class SearchByHash
 * @package Main\Search\Model
 */
class SearchByHash extends BaseSearch
{
    /**
     * @param string $string
     * @param int $line
     * @param string $searchValue
     * @return BaseResult
     */
    public function search(string $string, int $line, string $searchValue): BaseResult
    {
        $result = new BaseResult();

        if (hash_equals($string, $searchValue) !== false) {
            $result->setLine($line);
        }

        return $result;
    }
}