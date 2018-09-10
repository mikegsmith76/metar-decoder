<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment as SegmentData;
use Metar\Parser\Segment;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

/**
 * Class BaseSegment
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Segment
 */
abstract class BaseSegment implements Segment
{
    /**
     * @var string
     */
    protected $extractRegex = "";

    /**
     * @var string
     */
    protected $tokenRegex = "";

    /**
     * @return string
     */
    public function getExtractionRegex() : string
    {
        return $this->extractRegex;
    }

    /**
     * @return string
     */
    public function getTokenizationRegex() : string
    {
        return $this->tokenRegex;
    }


    /**
     * @param string $toParse
     * @return SegmentData
     * @throws InvalidDataException
     */
    public function parse(string $toParse) /*: SegmentData*/
    {
        $matches = [];

        if (false === preg_match($this->getExtractionRegex(), $toParse, $matches) || empty($matches)) {
            throw new InvalidDataException;
        }

        return $this->populateDataContainer($matches);
    }

    /**
     * @param array $data
     * @return SegmentData
     */
    abstract public function populateDataContainer(array $data) /*: SegmentData*/;
}