<?php

namespace Main\File\Model;

class StringIterator
{
    protected $descriptor = false;
    protected $line = 0;

    public function setDescriptor($descriptor)
    {
        $this->descriptor = $descriptor;
    }

    public function nextString(): ?string
    {
        $string = fgets($this->descriptor);
        if($string !== false){
            $this->line++;
        }
        return $string;
    }

    public function getLine()
    {
        return $this->line;
    }
}