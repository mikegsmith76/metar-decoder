<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Wind as WindData;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

/**
 * Class Wind
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Wind
{
    protected $pattern =
        "/" .
        "(?P<direction>" . WindData::DIRECTION_VARIABLE . "|[0-9]{3})" .
        // speed
        "(?P<speed>[0-9]{2})" .
        // optional gust
        "(?:G(?P<gust>[0-9]{2}))?" .
        // speed units
        "(?P<unit>" . WindData::SPEED_KNOTS . "|" . WindData::SPEED_KILOMETRES_PER_HOUR . "|" . WindData::SPEED_METRES_PER_SECOND . ")" .
        "/";

    /**
     * @param $segment
     * @return WindData
     * @throws InvalidDataException
     */
    public function parse($segment) : WindData
    {
        $matches = [];

        if (false === preg_match($this->pattern, $segment, $matches) || empty($matches)) {
            throw new InvalidDataException;
        }

        $data = new WindData;

        if (WindData::DIRECTION_VARIABLE === $matches["direction"]) {
            $data->setHasFixedDirection(false);
        } else {
            $data->setDirection((int) $matches["direction"]);
        }

        $data->setSpeed((int) $matches["speed"]);
        $data->setSpeedUnit($matches["unit"]);

        $gustSpeed = isset($matches['gust']) ? (int) $matches["gust"] : 0;
        $data->setGustSpeed($gustSpeed);
        return $data;
    }
}