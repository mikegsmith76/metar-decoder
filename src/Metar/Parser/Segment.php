<?php

namespace Metar\Parser;

use Metar\Parser;

/**
 * Interface Segment
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser
 */
interface Segment extends Parser
{
    /**
     * @return string
     */
    public function getExtractionRegex() : string;

    /**
     * @return string
     */
    public function getTokenizationRegex() : string;
}