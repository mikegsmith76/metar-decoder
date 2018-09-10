<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Wind as WindData;

/**
 * Class Wind
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Wind extends BaseSegment
{
    /**
     * @var string
     */
    protected $extractRegex =
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
     * @param array $data
     * @return WindData
     */
    public function populateDataContainer(array $data) /*: WindData*/
    {
        $dataContainer = new WindData;

        if (WindData::DIRECTION_VARIABLE === $data["direction"]) {
            $dataContainer->setHasFixedDirection(false);
        } else {
            $dataContainer->setDirection((int) $data["direction"]);
        }

        $dataContainer->setSpeed((int) $data["speed"]);
        $dataContainer->setSpeedUnit($data["unit"]);

        $gustSpeed = isset($data['gust']) ? (int) $data["gust"] : 0;
        $dataContainer->setGustSpeed($gustSpeed);

        return $dataContainer;
    }
}