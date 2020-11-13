<?php

namespace Main\Search\Model;

use Main\Search\Entity\AbstractResult;
use Main\Search\Entity\Result;

class FindSubstring extends BaseSearch
{
    public function search(string $string, int $line, string $searchValue): AbstractResult
    {
        $result = new Result();

        $position = strpos($string, $searchValue);
        if ($position !== false) {
            $result->setPosition($position)->setLine($line)->setStatus(true);
        }

        return $result;
    }
}