<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\CloudLayer as CloudLayerData;
use Metar\Parser\Segment;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

/**
 * Class CloudLayer
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
class CloudLayer implements Segment
{
    const HEIGHT_TO_FEET = 100;

    protected $pattern = "/"
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
     * @param string $toParse
     * @return CloudLayerData
     * @throws InvalidDataException
     */
    public function parse(string $toParse) : CloudLayerData
    {
        if (false === preg_match($this->pattern, $toParse, $matches) || empty($matches)) {
            throw new InvalidDataException;
        }

        $data = new CloudLayerData;

        $data->setCoverage($matches["coverage"]);
        $data->setHeightInFeet((int) $matches["height"] * self::HEIGHT_TO_FEET);

        $type = isset($matches["type"]) ? $matches["type"] : "";
        $data->setType($type);

        return $data;
    }
}