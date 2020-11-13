<?php


namespace Main\Search\Entity;

class Result
{
    protected $line = false;
    protected $position = false;

    public function getLine()
    {
        return $this->line;
    }

    public function setLine($line): Result
    {
        $this->line = $line;
        return $this;
    }

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