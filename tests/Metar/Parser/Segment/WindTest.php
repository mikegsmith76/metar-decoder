<?php

namespace Tests\Metar\Parser\Segment;

use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;
use Metar\Parser\Segment\Wind as WindSegment;
use PHPUnit\Framework\TestCase;

/**
 * Class WindTest
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Tests\Unit\Metar\Parser\Segment
 */
class WindTest extends TestCase
{
    const SPEED_KNOTS = "KT";
    const SPEED_KILOMETERS_PER_HOUR = "KPH";
    const SPEED_MILES_PER_HOUR = "MPH";

    protected $direction = 240;

    protected $gust = 35;

    protected $speed = 15;

    protected $variableDirection = "VRB";

    protected $segmentParser = null;

    protected $validSegment = "";

    protected $validSegmentWithGust = "";

    protected $validSegmentWithVariableDirection = "";

    protected $validSegmentWithVariableDirectionAndGust = "";

    public function setUp()
    {
        $this->segmentParser = new WindSegment;

        $this->validSegment = "{$this->direction}{$this->speed}" . self::SPEED_KNOTS;
        $this->validSegmentWithGust = "{$this->direction}{$this->speed}G{$this->gust}" . self::SPEED_KNOTS;
        $this->validSegmentWithVariableDirection = "{$this->variableDirection}{$this->speed}" . self::SPEED_KNOTS;
        $this->validSegmentWithVariableDirectionAndGust = "{$this->variableDirection}{$this->speed}G{$this->gust}" . self::SPEED_KNOTS;
    }

    /**
     * Wind Direction
     */

    public function testWindDirectionInDegrees()
    {
        $parsedData = $this->segmentParser->parse($this->validSegment);

        $this->assertTrue($parsedData->hasFixedDirection());
        $this->assertEquals($this->direction, $parsedData->getDirection());
    }

    public function testVariableWindDirection()
    {
        $parsedData = $this->segmentParser->parse($this->validSegmentWithVariableDirection);
        $this->assertFalse($parsedData->hasFixedDirection());
    }

    /**
     * Wind Speed
     */

    public function testWindSpeedInKnots()
    {
        $parsedData = $this->segmentParser->parse($this->validSegment);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(self::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKnotsWhenGustIsIncluded()
    {
        $parsedData = $this->segmentParser->parse($this->validSegmentWithGust);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(self::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKilometersPerHour()
    {
        $validSegmentInKph = "{$this->direction}{$this->speed}" . self::SPEED_KILOMETERS_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentInKph);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(self::SPEED_KILOMETERS_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKilometersPerHourWhenGustIsIncluded()
    {
        $validSegmentWithGustInKph = "{$this->direction}{$this->speed}G{$this->gust}" . self::SPEED_KILOMETERS_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInKph);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(self::SPEED_KILOMETERS_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInMilesPerHour()
    {
        $validSegmentInMph = "{$this->direction}{$this->speed}" . self::SPEED_MILES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentInMph);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(self::SPEED_MILES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInMilesPerHourWhenGustIsIncluded()
    {
        $validSegmentWithGustInMph = "{$this->direction}{$this->speed}G{$this->gust}" . self::SPEED_MILES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInMph);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(self::SPEED_MILES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInKnots()
    {
        $parsedData = $this->segmentParser->parse($this->validSegmentWithGust);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(self::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInKilometersPerHour()
    {
        $validSegmentWithGustInKph = "{$this->direction}{$this->speed}G{$this->gust}" . self::SPEED_KILOMETERS_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInKph);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(self::SPEED_KILOMETERS_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInMilesPerHour()
    {
        $validSegmentWithGustInMph = "{$this->direction}{$this->speed}G{$this->gust}" . self::SPEED_MILES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInMph);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(self::SPEED_MILES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    /**
     * Failure to parse
     */

    public function testThrowsExceptionIfDataCannotBeParsed()
    {
        $this->expectException(InvalidDataException::class);
        $this->segmentParser->parse("");
    }
}