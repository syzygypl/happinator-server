<?php

namespace AppBundle\ValueObject;

class Period
{

    /** @var \DateTime */
    private $from;

    /** @var \DateTime */
    private $to;

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     */
    public function __construct(\DateTime $from, \DateTime $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return \DateTime
     */
    public function getFrom(): \DateTime
    {
        return $this->from;
    }

    /**
     * @return \DateTime
     */
    public function getTo(): \DateTime
    {
        return $this->to;
    }

}