<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Temperature as TemperatureData;

/**
 * Class Temperature
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Temperature extends BaseSegment
{
    const SIGN_MODIFIER = "M";

    /**
     * @var string
     */
    protected $extractRegex = "/"
        . "(?<air_temp_sign>" . self::SIGN_MODIFIER . ")?"
        . "(?<air_temp>[0-9]{2})"
        . "\/"
        . "(?<dew_point_temp_sign>" . self::SIGN_MODIFIER . ")?"
        . "(?<dew_point_temp>[0-9]{2})"
        . "/";

    /**
     * @param array $data
     * @return TemperatureData
     */
    public function populateDataContainer(array $data) /*: TemperatureData*/
    {
        $airTempSign = isset($data["air_temp_sign"]) && self::SIGN_MODIFIER === $data["air_temp_sign"] ? -1 : 1;
        $dewPointTempSign = isset($data["dew_point_temp_sign"]) && self::SIGN_MODIFIER === $data["dew_point_temp_sign"] ? -1 : 1;

        $dataContainer = new TemperatureData;

        $dataContainer->setAirInCelsius((int) $data["air_temp"] * $airTempSign);
        $dataContainer->setDewPointInCelsius((int) $data["dew_point_temp"] * $dewPointTempSign);

        return $dataContainer;
    }
}