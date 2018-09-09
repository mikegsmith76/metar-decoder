<?php

namespace Metar\Parser\Data\Segment;

/**
 * Class CloudLayer
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Metar\Parser\Data\Segment
 */
class CloudLayer
{
    const COVERAGE_NONE = "SKC";
    const COVERAGE_FEW = "FEW";
    const COVERAGE_SCATTERED = "SCT";
    const COVERAGE_BROKEN = "BKN";
    const COVERAGE_FULL = "OVC";

    const TYPE_CUMULONIMBUS = "CB";
    const TYPE_TOWERING_CUMULUS = "TCU";

    /**
     * @var string
     */
    protected $coverage = self::COVERAGE_NONE;

    /**
     * @var int
     */
    protected $heightInFeet = 0;

    /**
     * @var string
     */
    protected $type = '';

    /**
     * @return string
     */
    public function getCoverage() : string
    {
        return $this->coverage;
    }

    /**
     * @return int
     */
    public function getHeightInFeet() : int
    {
        return $this->heightInFeet;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param string $coverage
     */
    public function setCoverage(string $coverage)
    {
        $this->coverage = $coverage;
    }

    /**
     * @param int $heightInFeet
     */
    public function setHeightInFeet(int $heightInFeet)
    {
        $this->heightInFeet = $heightInFeet;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}