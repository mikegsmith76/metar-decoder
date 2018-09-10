<?php

namespace Metar\Parser\Segment\Collection;

use Metar\Parser\Segment\Collection;
use Metar\Parser\Segment\Airfield;
use Metar\Parser\Segment\Issued;

class All extends Collection
{
    public function __construct()
    {
        $this->addSegment(new Airfield);
        $this->addSegment(new Issued);
    }
}