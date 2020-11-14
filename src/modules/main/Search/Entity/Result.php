<?php


namespace Main\Search\Entity;

/**
 * Class Result
 * @package Main\Search\Entity
 */
class Result extends BaseResult
{

    /**
     * @var bool
     */
    protected $position = false;

    /**
     * @return bool
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     * @return $this
     */
    public function setPosition($position): Result
    {
        $this->position = $position;
        return $this;
    }
}