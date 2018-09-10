<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Data\Segment\Visibility as VisibilityData;
use Metar\Parser\Segment;
use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;

/**
 * Class Visibility
 *
 * @author Mike Smith <mail@mikegsmith.co.uk> *
 * @package Metar\Parser\Segment
 */
class Visibility implements Segment
{
    /**
     * @var string
     */
    protected $pattern = "/"
        . "(?<visibility>[0-9]{4})"
        . "(?<direction>[A-Z]{2})?"
        . "/";

    /**
     * @param string $toParse
     * @return VisibilityData
     * @throws InvalidDataException
     */
    public function parse(string $toParse) : VisibilityData
    {
        $matches = [];

        if (false === preg_match($this->pattern, $segment, $matches) || empty($matches)) {
            throw new InvalidDataException;
        }

        $data = new VisibilityData;

        $data->setHorizontalInMetres((int) $matches["visibility"]);

        $direction = isset($matches['direction']) ? $matches['direction'] : '';
        $data->setDirection($direction);

        return $data;
    }
}