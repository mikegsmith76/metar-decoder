<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Issued as IssuedData;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

/**
 * Class Issued
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Issued
{
    /**
     * @var string
     *
     * Example 021950Z
     */
    protected $pattern = "/"
        . "(?<day_of_month>[0-9]{2})"
        . "(?<hour>[0-9]{2})"
        . "(?<minute>[0-9]{2})"
        . "Z"
        . "/";

    /**
     * @param $segment
     * @return IssuedData
     * @throws InvalidDataException
     */
    public function parse($segment) : IssuedData
    {
        if (false === preg_match($this->pattern, $segment, $matches) || empty($matches)) {
            throw new InvalidDataException;
        }

        $data = new IssuedData;

        $data->setDayOfMonth($matches["day_of_month"]);
        $data->setHour($matches["hour"]);
        $data->setMinute($matches["minute"]);

        return $data;
    }
}