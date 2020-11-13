<?php


namespace Main\Search\Entity;


abstract class AbstractResult
{
    protected $status = false;

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return AbstractResult
     */
    public function setStatus(bool $status): AbstractResult
    {
        $this->status = $status;
        return $this;
    }


}