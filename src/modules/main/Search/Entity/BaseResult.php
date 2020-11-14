<?php


namespace Main\Search\Entity;


/**
 * Class BaseResult
 * @package Main\Search\Entity
 */
class BaseResult
{
    protected $line = false;

    public function getLine()
    {
        return $this->line;
    }

    public function setLine(int $line): BaseResult
    {
        $this->line = $line;
        return $this;
    }
}