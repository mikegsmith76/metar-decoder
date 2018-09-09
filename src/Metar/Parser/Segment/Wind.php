<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Wind as WindData;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

class Wind
{
    const DIRECTION_VARIABLE = "VRB";

    const SPEED_KNOTS = "KT";
    const SPEED_KILOMETERS_PER_HOUR = "KPH";
    const SPEED_MILES_PER_HOUR = "MPH";

    protected $pattern =
        "/" .
        "(?P<direction>" . self::DIRECTION_VARIABLE . "|[0-9]{3})" .
        // speed
        "(?P<speed>[0-9]{2})" .
        // optional gust
        "(?:G(?P<gust>[0-9]{2}))?" .
        // speed units
        "(?P<unit>" . self::SPEED_KNOTS . "|" . self::SPEED_KILOMETERS_PER_HOUR . "|" . self::SPEED_MILES_PER_HOUR . ")" .
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

        if (self::DIRECTION_VARIABLE === $matches["direction"]) {
            $data->setHasFixedDirection(false);
        } else {
            $data->setDirection((int) $matches["direction"]);
        }

        $speed = (int) $matches["speed"];
        $gustSpeed = isset($matches['gust']) ? (int) $matches["gust"] : 0;
        $unit = $matches["unit"];

        if (self::SPEED_KNOTS !== $unit) {
            $speed = $this->convertSpeedToKnots($speed, $unit);
            $gustSpeed = $this->convertSpeedToKnots($gustSpeed, $unit);
        }

        $data->setSpeed($speed);
        $data->setGustSpeed($gustSpeed);
        $data->setSpeedUnit($unit);

        return $data;
    }

    /**
     * @param int $speed
     * @param string $unit
     * @return int
     */
    protected function convertSpeedToKnots(int $speed, string $unit) : int
    {
        return $speed;
    }
}