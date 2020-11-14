<?php

namespace Main\Search\Model;

use Main\Search\Entity\BaseResult;
use Main\Search\Entity\Result;

/**
 * Class FindSubstring
 * @package Main\Search\Model
 */
class FindSubstring extends BaseSearch
{
    /**
     * @param string $string
     * @param int $line
     * @param string $searchValue
     * @return BaseResult
     */
    public function search(string $string, int $line, string $searchValue): BaseResult
    {
        $result = new Result();

        $position = strpos($string, $searchValue);
        if ($position !== false) {
            $result->setPosition($position)->setLine($line);
        }

        return $result;
    }
}