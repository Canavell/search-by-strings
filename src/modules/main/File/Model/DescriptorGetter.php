<?php


namespace Main\File\Model;


use Main\Exception\MaxSizeException;
use Main\Exception\MimeTypeException;

class DescriptorGetter
{
    protected $pathToFile;
    protected $config = [];
    protected $descriptor = false;

    public function __construct(string $pathToFile, array $config = [])
    {
        $this->pathToFile = $pathToFile;
        $this->config = $config;
    }

    public function getDescriptor()
    {
        if (filter_var($this->pathToFile, FILTER_VALIDATE_URL)) {
            $newPath = realpath(__DIR__ . '/../../../../../data/') . '/' . uniqid() . ".data";

            file_put_contents($newPath, $this->readFile($this->pathToFile));

            $this->descriptor = $this->readFile($newPath);
            $this->pathToFile = $newPath;
        } else {
            $this->descriptor = $this->readFile($this->pathToFile);
        }

        if(count($this->config)){
            $this->makeChecks();
        }

        return $this->descriptor;
    }

    public function closeDescriptor()
    {
        fclose($this->descriptor);
        unlink($this->pathToFile);

    }

    protected function readFile($path)
    {
        return fopen($path, 'r');
    }

    protected function makeChecks()
    {
        if ($this->descriptor === false) {
            return false;
        }

        $mimeType = mime_content_type($this->pathToFile);
        if(!in_array($mimeType, $this->config['allowed_mime_types'])){
            throw new MimeTypeException($mimeType . ' is not allowed mime type, allowe only types: ' . implode(', ', $this->config['allowed_mime_types']));
        }


        $size = filesize($this->pathToFile) / 1048576 ;
        if ($size > $this->config['max_size_mb']) {
            throw new MaxSizeException("The file is too large. Max file size is {$this->config['max_size_mb']}MB, but your file is {$size}MB");
        }

        return true;
    }
}