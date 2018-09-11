<?php

namespace Metar\Parser\Tokenizer;

use Metar\Parser\Segment;
use Metar\Parser\Tokenizer;
use Metar\Parser\Tokenizer\Result as ResultInterface;
use Metar\Parser\Tokenizer\Result\Result;
use Metar\Parser\Tokenizer\Exception\UnableToTokenize as UnableToTokenizeException;

/**
 * Class Regex
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Tokenizer
 */
class Regex implements Tokenizer
{
    /**
     * @var Result
     */
    protected $result = null;

    /**
     * @param Segment $segment
     * @param string $toTokenize
     * @return \Metar\Parser\Tokenizer\Result
     * @throws UnableToTokenizeException
     */
    public function getTokensForSegment(Segment $segment, string $toTokenize) : ResultInterface
    {
        $this->result = new Result;

        $remaining = preg_replace_callback($segment->getTokenizationRegex(), [$this, 'captureTokens'] , $toTokenize);
        if (null === $remaining) {
            throw new UnableToTokenizeException;
        }

        $this->result->setRemaining(trim($remaining));
        return $this->result;
    }

    /**
     * @param array $matches
     * @return string
     */
    protected function captureTokens(array $matches)
    {
        $this->result->addToken($matches[0]);
        return '';
    }
}