<?php

namespace Metar;

use Metar\Parser\Data\Segment as SegmentData;

/**
 * Class Parser
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar
 */
interface Parser
{
    /**
     * Parse a string segment into an appropriate data container
     *
     * Unfortunately PHP's type system sucks and doesn't support covariant return types - therefore the return type has had to be removed
     *
     * @param string $toParse
     * @return SegmentData
     */
    public function parse(string $toParse) /*: SegmentData*/;
}