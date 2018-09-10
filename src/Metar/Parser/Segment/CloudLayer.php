<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\CloudLayer as CloudLayerData;

/**
 * Class CloudLayer
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class CloudLayer extends BaseSegment
{
    const HEIGHT_TO_FEET = 100;

    /**
     * @var string
     */
    protected $extractRegex = "/"
        . "(?<coverage>"
            . CloudLayerData::COVERAGE_NONE . "|"
            . CloudLayerData::COVERAGE_FEW . "|"
            . CloudLayerData::COVERAGE_SCATTERED . "|"
            . CloudLayerData::COVERAGE_BROKEN . "|"
            . CloudLayerData::COVERAGE_FULL . "|"
        . ")"
        . "(?<height>[0-9]{3})"
        . "(?<type>"
            . CloudLayerData::TYPE_CUMULONIMBUS . "|"
            . CloudLayerData::TYPE_TOWERING_CUMULUS . "|"
        . ")?"
        . "/";


    /**
     * @param array $data
     * @return CloudLayerData
     */
    public function populateDataContainer(array $data) /*: CloudLayerData*/
    {
        $dataContainer = new CloudLayerData;

        $dataContainer->setCoverage($data["coverage"]);
        $dataContainer->setHeightInFeet((int) $data["height"] * self::HEIGHT_TO_FEET);

        $type = isset($data["type"]) ? $data["type"] : "";
        $dataContainer->setType($type);

        return $dataContainer;
    }
}