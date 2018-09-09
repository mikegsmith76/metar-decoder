<?php

namespace Metar\Parser\Data\Segment;

/**
 * Class Airfield
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Data\Segment
 */
class Airfield
{
    /**
     * @var string
     */
    public $code = '';

    /**
     * @return string
     */
    public function getCode() : string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code) : void
    {
        $this->code = $code;
    }
}