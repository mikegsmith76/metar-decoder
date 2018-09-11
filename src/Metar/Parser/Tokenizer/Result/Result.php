<?php

namespace Metar\Parser\Tokenizer\Result;

use Metar\Parser\Tokenizer\Result as ResultInterface;

/**
 * Class Result
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Tokenizer\Result
 */
class Result implements ResultInterface
{
    protected $remaining = "";

    /**
     * @var array
     */
    protected $tokens = [];

    /**
     * @param string $token
     */
    public function addToken(string $token) : void
    {
        $this->tokens[] = $token;
    }

    /**
     * @return array
     */
    public function getTokens() : array
    {
        return $this->tokens;
    }

    /**
     * @return string
     */
    public function getRemaining() : string
    {
        return $this->remaining;
    }

    /**
     * @param string $remaining
     */
    public function setRemaining(string $remaining) : void
    {
        $this->remaining = $remaining;
    }
}