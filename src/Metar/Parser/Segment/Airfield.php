<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Airfield as AirfieldData;

/**
 * Class Airfield
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class Airfield extends BaseSegment
{
    /**
     * @var string
     */
    protected $extractRegex = "/(?<code>[A-Z]{4})/";

    /**
     * @param array $data
     * @return AirfieldData
     */
    public function populateDataContainer(array $data) /*: AirfieldData*/
    {
        $dataContainer = new AirfieldData;

        $dataContainer->setCode($data["code"]);

        return $dataContainer;
    }
}