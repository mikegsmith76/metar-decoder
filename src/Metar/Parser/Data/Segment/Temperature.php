<?php

namespace Metar\Parser\Data\Segment;

/**
 * Class Temperature
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Data\Segment
 */
class Temperature
{
    /**
     * @var int
     */
    protected $airTemperature = 0;

    /**
     * @var int
     */
    protected $dewPointTemperature = 0;

    /**
     * @return int
     */
    public function getAirInCelsius() : int
    {
        return $this->airTemperature;
    }

    /**
     * @return int
     */
    public function getDewPointInCelsius() : int
    {
        return $this->dewPointTemperature;
    }

    /**
     * @param int $airTemperature
     */
    public function setAirInCelsius(int $airTemperature) : void
    {
        $this->airTemperature = $airTemperature;
    }

    /**
     * @param int $dewPointTemperature
     */
    public function setDewPointInCelsius(int $dewPointTemperature): void
    {
        $this->dewPointTemperature = $dewPointTemperature;
    }
}