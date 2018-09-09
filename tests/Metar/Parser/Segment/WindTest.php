<?php

namespace Tests\Metar\Parser\Segment;

use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;
use Metar\Parser\Segment\Wind as WindSegment;
use Metar\Parser\Data\Segment\Wind as WindData;
use PHPUnit\Framework\TestCase;

/**
 * Class WindTest
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Tests\Unit\Metar\Parser\Segment
 */
class WindTest extends TestCase
{
    /**
     * @var int
     */
    protected $direction = 240;

    /**
     * @var int
     */
    protected $gust = 35;

    /**
     * @var int
     */
    protected $speed = 15;

    /**
     * @var string
     */
    protected $variableDirection = "VRB";

    /**
     * @var WindSegment
     */
    protected $segmentParser = null;

    /**
     * @var string
     */
    protected $validSegment = "";

    /**
     * @var string
     */
    protected $validSegmentWithGust = "";

    /**
     * @var string
     */
    protected $validSegmentWithVariableDirection = "";

    /**
     * @var string
     */
    protected $validSegmentWithVariableDirectionAndGust = "";

    public function setUp()
    {
        $this->segmentParser = new WindSegment;

        $this->validSegment = "{$this->direction}{$this->speed}" . WindData::SPEED_KNOTS;
        $this->validSegmentWithGust = "{$this->direction}{$this->speed}G{$this->gust}" . WindData::SPEED_KNOTS;
        $this->validSegmentWithVariableDirection = "{$this->variableDirection}{$this->speed}" . WindData::SPEED_KNOTS;
        $this->validSegmentWithVariableDirectionAndGust = "{$this->variableDirection}{$this->speed}G{$this->gust}" . WindData::SPEED_KNOTS;
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
        $this->assertEquals(WindData::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKnotsWhenGustIsIncluded()
    {
        $parsedData = $this->segmentParser->parse($this->validSegmentWithGust);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindData::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKilometersPerHour()
    {
        $validSegmentInKph = "{$this->direction}{$this->speed}" . WindData::SPEED_KILOMETRES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentInKph);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindData::SPEED_KILOMETRES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInKilometersPerHourWhenGustIsIncluded()
    {
        $validSegmentWithGustInKph = "{$this->direction}{$this->speed}G{$this->gust}" . WindData::SPEED_KILOMETRES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInKph);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindData::SPEED_KILOMETRES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInMetresPerSecond()
    {
        $validSegmentInMps = "{$this->direction}{$this->speed}" . WindData::SPEED_METRES_PER_SECOND;

        $parsedData = $this->segmentParser->parse($validSegmentInMps);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindData::SPEED_METRES_PER_SECOND, $parsedData->getSpeedUnit());
    }

    public function testWindSpeedInMetresPerSecondWhenGustIsIncluded()
    {
        $validSegmentWithGustInMps = "{$this->direction}{$this->speed}G{$this->gust}" . WindData::SPEED_METRES_PER_SECOND;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInMps);

        $this->assertEquals($this->speed, $parsedData->getSpeed());
        $this->assertEquals(WindData::SPEED_METRES_PER_SECOND, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInKnots()
    {
        $parsedData = $this->segmentParser->parse($this->validSegmentWithGust);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(WindData::SPEED_KNOTS, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInKilometersPerHour()
    {
        $validSegmentWithGustInKph = "{$this->direction}{$this->speed}G{$this->gust}" . WindData::SPEED_KILOMETRES_PER_HOUR;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInKph);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(WindData::SPEED_KILOMETRES_PER_HOUR, $parsedData->getSpeedUnit());
    }

    public function testGustSpeedInMetresPerSecond()
    {
        $validSegmentWithGustInMps = "{$this->direction}{$this->speed}G{$this->gust}" . WindData::SPEED_METRES_PER_SECOND;

        $parsedData = $this->segmentParser->parse($validSegmentWithGustInMps);

        $this->assertEquals($this->gust, $parsedData->getGustSpeed());
        $this->assertEquals(WindData::SPEED_METRES_PER_SECOND, $parsedData->getSpeedUnit());
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