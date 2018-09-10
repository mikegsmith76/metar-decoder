<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Issued as IssuedData;

/**
 * Class Issued
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Issued extends BaseSegment
{
    /**
     * @var string
     *
     * Example 021950Z
     */
    protected $extractRegex = "/"
        . "(?<day_of_month>[0-9]{2})"
        . "(?<hour>[0-9]{2})"
        . "(?<minute>[0-9]{2})"
        . "Z"
        . "/";

    /**
     * @param array $data
     * @return IssuedData
     */
    public function populateDataContainer(array $data) /*: IssuedData*/
    {
        $dataContainer = new IssuedData;

        $dataContainer->setDayOfMonth($data["day_of_month"]);
        $dataContainer->setHour($data["hour"]);
        $dataContainer->setMinute($data["minute"]);

        return $dataContainer;
    }
}