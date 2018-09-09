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

        $this->validSegment = "{$this->direction}{$this->speed}" . WindSegment::SPEED_KNOTS;
        $this->validSegmentWithGust = "{$this->direction}{$this->speed}G{$this->gust}" . WindSegment::SPEED_KNOTS;
        $this->validSegmentWithVariableDirection = "{$this->variableDirection}{$this->speed}" . WindSegment::SPEED_KNOTS;
        $this->validSegmentWithVariableDirectionAndGust = "{$this->variableDirection}{$this->speed}G{$this->gust}" . WindSegment::SPEED_KNOTS;
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
        $this->assertEquals(WindSegment::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKnotsWhenGustIsIncluded()
    {
        $parsedData = $this->segmentParser->parse($this->validSegmentWithGust);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindSegment::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKilometersPerHour()
    {
        $validSegmentInKph = "{$this->direction}{$this->speed}" . WindSegment::SPEED_KILOMETRES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentInKph);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindSegment::SPEED_KILOMETRES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKilometersPerHourWhenGustIsIncluded()
    {
        $validSegmentWithGustInKph = "{$this->direction}{$this->speed}G{$this->gust}" . WindSegment::SPEED_KILOMETRES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInKph);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindSegment::SPEED_KILOMETRES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInMetresPerSecond()
    {
        $validSegmentInMps = "{$this->direction}{$this->speed}" . WindSegment::SPEED_METRES_PER_SECOND;

        $parsedData = $this->segmentParser->parse($validSegmentInMps);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindSegment::SPEED_METRES_PER_SECOND, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInMetresPerSecondWhenGustIsIncluded()
    {
        $validSegmentWithGustInMps = "{$this->direction}{$this->speed}G{$this->gust}" . WindSegment::SPEED_METRES_PER_SECOND;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInMps);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindSegment::SPEED_METRES_PER_SECOND, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInKnots()
    {
        $parsedData = $this->segmentParser->parse($this->validSegmentWithGust);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(WindSegment::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInKilometersPerHour()
    {
        $validSegmentWithGustInKph = "{$this->direction}{$this->speed}G{$this->gust}" . WindSegment::SPEED_KILOMETRES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInKph);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(WindSegment::SPEED_KILOMETRES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInMetresPerSecond()
    {
        $validSegmentWithGustInMps = "{$this->direction}{$this->speed}G{$this->gust}" . WindSegment::SPEED_METRES_PER_SECOND;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInMps);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(WindSegment::SPEED_METRES_PER_SECOND, $parsedData->getSpeedUnit());
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