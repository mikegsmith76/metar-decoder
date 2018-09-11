<?php

namespace Metar\Parser\Tokenizer;

/**
 * Interface Result
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Tokenizer
 */
interface Result
{
    /**
     * @return array
     */
    public function getTokens() : array;

    /**
     * @return string
     */
    public function getRemaining() : string;
}