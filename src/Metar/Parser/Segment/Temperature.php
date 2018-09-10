<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Temperature as TemperatureData;
use Metar\Parser\Segment;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

/**
 * Class Temperature
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Temperature implements Segment
{
    const SIGN_MODIFIER = "M";

    /**
     * @var string
     */
    protected $pattern = "/"
        . "(?<air_temp_sign>" . self::SIGN_MODIFIER . ")?"
        . "(?<air_temp>[0-9]{2})"
        . "\/"
        . "(?<dew_point_temp_sign>" . self::SIGN_MODIFIER . ")?"
        . "(?<dew_point_temp>[0-9]{2})"
        . "/";

    /**
     * @param string $toParse
     * @return TemperatureData
     * @throws InvalidDataException
     */
    public function parse(string $toParse) : TemperatureData
    {
        $matches = [];

        if (false === preg_match($this->pattern, $toParse, $matches) || empty($matches)) {
            throw new InvalidDataException;
        }

        $airTempSign = isset($matches["air_temp_sign"]) && self::SIGN_MODIFIER === $matches["air_temp_sign"] ? -1 : 1;
        $dewPointTempSign = isset($matches["dew_point_temp_sign"]) && self::SIGN_MODIFIER === $matches["dew_point_temp_sign"] ? -1 : 1;

        $data = new TemperatureData;

        $data->setAirInCelsius((int) $matches["air_temp"] * $airTempSign);
        $data->setDewPointInCelsius((int) $matches["dew_point_temp"] * $dewPointTempSign);

        return $data;
    }
}