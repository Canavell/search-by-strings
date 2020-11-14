<?php


namespace Main\Search\Entity;

class Result extends BaseResult
{

    protected $position = false;

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position): Result
    {
        $this->position = $position;
        return $this;
    }
}