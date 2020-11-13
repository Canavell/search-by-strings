<?php


namespace Main\File\Model;


use Main\Exception\MaxSizeException;
use Main\Exception\MimeTypeException;

class DescriptorGetter
{
    protected $pathToFile;
    protected $config;
    protected $descriptor = false;

    public function __construct(string $pathToFile, array $config)
    {
        $this->pathToFile = $pathToFile;
        $this->config = $config;
    }

    public function getDescriptor()
    {
        if (filter_var($this->pathToFile, FILTER_VALIDATE_URL)) {
            $pathinfo = pathinfo($this->pathToFile);
            $newPath = realpath(__DIR__ . '/../../../../../data/') . $pathinfo['name'] . "." . $pathinfo['ext'];

            file_put_contents($newPath, $this->readFile($this->pathToFile));

            $this->descriptor = $newPath;
        } else {
            $this->descriptor = $this->readFile($this->pathToFile);
        }

        $this->makeChecks();

        return $this->descriptor;
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

        if ($mimeType !== $this->config['allowed_mime_types']) {
            throw new MimeTypeException($mimeType . ' is not allowe mime type');
        }

        $size = floor(filesize($this->pathToFile) / 1000000);
        if ($size > $this->config['max_size_mb']) {
            throw new MaxSizeException("The file is too large. Max file size is {$this->config['max_size_mb']}MB, but your file is {$size}MB");
        }

        return true;
    }
}