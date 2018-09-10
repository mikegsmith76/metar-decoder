<?php

namespace Metar\Parser\Data\Segment;

use Metar\Parser\Data\Segment;

/**
 * Class Issued
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Data\Segment
 */
class Issued extends Segment
{
    /**
     * @var int
     */
    protected $dayOfMonth = 1;

    /**
     * @var int
     */
    protected $hour = 0;

    /**
     * @var int
     */
    protected $minute = 0;

    /**
     * @return int
     */
    public function getDayOfMonth(): int
    {
        return $this->dayOfMonth;
    }

    /**
     * @return int
     */
    public function getHour() : int
    {
        return $this->hour;
    }

    /**
     * @return int
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * @param $dayOfMonth
     */
    public function setDayOfMonth($dayOfMonth) : void
    {
        $this->dayOfMonth = $dayOfMonth;
    }

    /**
     * @param $hour
     */
    public function setHour($hour) : void
    {
        $this->hour = $hour;
    }

    /**
     * @param $minute
     */
    public function setMinute($minute) : void
    {
        $this->minute = $minute;
    }
}