<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Visibility as VisibilityData;

/**
 * Class Visibility
 *
 * @author Mike Smith <mail@mikegsmith.co.uk> *
 * @package Metar\Parser\Segment
 */
class Visibility extends BaseSegment
{
    /**
     * @var string
     */
    protected $extractRegex = "/"
        . "(?<visibility>[0-9]{4})"
        . "(?<direction>[A-Z]{2})?"
        . "/";

    /**
     * @param array $data
     * @return VisibilityData
     */
    public function populateDataContainer(array $data) /*: VisibilityData*/
    {
        $dataContainer = new VisibilityData;

        $dataContainer->setHorizontalInMetres((int) $data["visibility"]);

        $direction = isset($data['direction']) ? $data['direction'] : '';
        $dataContainer->setDirection($direction);

        return $dataContainer;
    }
}