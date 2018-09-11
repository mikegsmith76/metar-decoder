<?php

namespace Metar\Parser;

use Metar\Parser\Tokenizer\Result;

/**
 * Interface Tokenizer
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser
 */
interface Tokenizer
{
    /**
     * @param Segment $segment
     * @param string $toTokenize
     * @return Result
     */
    public function getTokensForSegment(Segment $segment, string $toTokenize) : Result;
}