<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Airfield as AirfieldData;
use Metar\Parser\Segment;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

/**
 * Class Airfield
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Airfield implements Segment
{
    /**
     * @var string
     */
    protected $pattern = "/(?<code>[A-Z]{4})/";

    /**
     * @param string $segment
     * @return AirfieldData
     * @throws InvalidDataException
     */
    public function parse(string $segment) : AirfieldData
    {
        if (false === preg_match($this->pattern, $segment, $matches) || empty($matches)) {
            throw new InvalidDataException;
        }

        $data = new AirfieldData;

        $data->setCode($matches["code"]);

        return $data;
    }
}