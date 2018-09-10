<?php

namespace Metar\Parser\Segment;

use Metar\Parser\Segment;

/**
 * Class Collection
 * @package Metar\Parser\Segment
 */
class Collection implements \Countable, \IteratorAggregate
{
    /**
     * @var Segment[]
     */
    protected $segments = [];

    /**
     * @param Segment $segment
     */
    public function addSegment(Segment $segment)
    {
        $this->segments[] = $segment;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->segments);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->segments);
    }
}