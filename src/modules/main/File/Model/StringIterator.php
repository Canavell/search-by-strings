<?php

namespace Main\File\Model;

/**
 * Class StringIterator
 * @package Main\File\Model
 */
class StringIterator
{
    /**
     * @var bool
     */
    protected $descriptor = false;
    /**
     * @var int
     */
    protected $line = 0;

    /**
     * @param $descriptor
     */
    public function setDescriptor($descriptor)
    {
        $this->descriptor = $descriptor;
    }

    /**
     * @return string|null
     */
    public function nextString(): ?string
    {
        $string = fgets($this->descriptor);
        if($string !== false){
            $this->line++;
        }
        return $string;
    }

    /**
     * @return int
     */
    public function getLine()
    {
        return $this->line;
    }
}