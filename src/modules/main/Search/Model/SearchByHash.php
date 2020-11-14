<?php


namespace Main\Search\Model;


use Main\Search\Entity\BaseResult;

class SearchByHash extends BaseSearch
{
    public function search(string $string, int $line, string $searchValue): BaseResult
    {
        $result = new BaseResult();

        if (hash_equals($string, $searchValue) !== false) {
            $result->setLine($line);
        }

        return $result;
    }
}