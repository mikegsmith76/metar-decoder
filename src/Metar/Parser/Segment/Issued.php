<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Issued as IssuedData;
use Metar\Parser\Segment;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

/**
 * Class Issued
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Issued implements Segment
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
     * @param string $toParse
     * @return IssuedData
     * @throws InvalidDataException
     */
    public function parse(string $toParse) : IssuedData
    {
        if (false === preg_match($this->pattern, $toParse, $matches) || empty($matches)) {
            throw new InvalidDataException;
        }

        $data = new IssuedData;

        $data->setDayOfMonth($matches["day_of_month"]);
        $data->setHour($matches["hour"]);
        $data->setMinute($matches["minute"]);

        return $data;
    }
}