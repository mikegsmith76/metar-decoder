<?php

namespace Metar\Parser\Data\Segment;

/**
 * Class Wind
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Data\Segment
 */
class Wind
{
    const DIRECTION_VARIABLE = "VRB";

    const SPEED_KNOTS = "KT";
    const SPEED_KILOMETRES_PER_HOUR = "KPH";
    const SPEED_METRES_PER_SECOND = "MPS";

    /**
     * @var int
     */
    protected $direction = 0;


    /**
     * @var int
     */
    protected $gustSpeed = 0;

    /**
     * @var bool
     */
    protected $hasFixedDirection = true;

    /**
     * @var int
     */
    protected $speed = 0;

    /**
     * @var string
     */
    protected $speedUnit = "KT";

    /**
     * @return int
     */
    public function getDirection() : int
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getGustSpeed() : int
    {
        return $this->gustSpeed;
    }

    /**
     * @return int
     */
    public function getSpeed() : int
    {
        return $this->speed;
    }

    /**
     * @return string
     */
    public function getSpeedUnit() : string
    {
        return $this->speedUnit;
    }

    /**
     * @return bool
     */
    public function hasFixedDirection() : bool
    {
        return $this->hasFixedDirection;
    }

    /**
     * @param int $direction
     */
    public function setDirection(int $direction) : void
    {
        $this->direction = $direction;
    }

    /**
     * @param int $gustSpeed
     */
    public function setGustSpeed(int $gustSpeed) : void
    {
        $this->gustSpeed = $gustSpeed;
    }

    /**
     * @param $hasFixedDirection
     */
    public function setHasFixedDirection($hasFixedDirection) : void
    {
        $this->hasFixedDirection = $hasFixedDirection;
    }

    /**
     * @param int $speed
     */
    public function setSpeed(int $speed) : void
    {
        $this->speed = $speed;
    }

    /**
     * @param string $speedUnit
     */
    public function setSpeedUnit(string $speedUnit) : void
    {
        $this->speedUnit = $speedUnit;
    }
}