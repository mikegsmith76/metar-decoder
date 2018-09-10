<?php

namespace Metar\Parser\Data\Segment;

use Metar\Parser\Data\Segment;

/**
 * Class Visibility
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Data\Segment
 */
class Visibility extends Segment
{
    /**
     * @var string
     */
    protected $direction = '';

    /**
     * @var int
     */
    protected $horizontalInMetres = 0;

    /**
     * @return string
     */
    public function getDirection() : string
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getHorizontalInMetres() : int
    {
        return $this->horizontalInMetres;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction) : void
    {
        $this->direction = $direction;
    }

    /**
     * @param int $horizontalInMetres
     */
    public function setHorizontalInMetres(int $horizontalInMetres) : void
    {
        $this->horizontalInMetres = $horizontalInMetres;
    }
}