<?php

namespace Main\File\Model;

class StringIterator
{
    protected $path = '';
    protected $descriptor = false;
    protected $line = 0;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function init()
    {
        if ($this->descriptor === false) {
            $this->descriptor = fopen($this->path, "r");
        }
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