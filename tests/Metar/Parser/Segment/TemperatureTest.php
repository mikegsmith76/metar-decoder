<?php

namespace Tests\Metar\Parser\Segment;

use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;
use Metar\Parser\Segment\Temperature as TemperatureSegment;
use PHPUnit\Framework\TestCase;

/**
 * Class TemperatureTest
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Tests\Metar\Parser\Segment
 */
class TemperatureTest extends TestCase
{
    /**
     * @var int
     */
    protected $airTemperature = 18;

    /**
     * @var int
     */
    protected $dewPointTemperature = 35;

    /**
     * @var string
     */
    protected $signModifier = 'M';

    /**
     * @var TemperatureSegment
     */
    protected $segmentParser = null;

    public function setUp()
    {
        $this->segmentParser = new TemperatureSegment;
    }

    public function testAirTemperatureInCelsius()
    {
        $segment = "{$this->airTemperature}/{$this->dewPointTemperature}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->airTemperature, $data->getAirInCelsius());
    }

    public function testAirTemperatureInCelsiusIsNegativeWithSignModifier()
    {
        $segment = "{$this->signModifier}{$this->airTemperature}/{$this->dewPointTemperature}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->airTemperature * -1, $data->getAirInCelsius());
    }

    public function testAirTemperatureInCelsiusWithOnlyDewPointSignModifier()
    {
        $segment = "{$this->airTemperature}/{$this->signModifier}{$this->dewPointTemperature}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->airTemperature, $data->getAirInCelsius());
    }

    public function testDewPointTemperatureInCelsius()
    {
        $segment = "{$this->airTemperature}/{$this->dewPointTemperature}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->dewPointTemperature, $data->getDewPointInCelsius());
    }

    public function testDewPointTemperatureInCelsiusIsNegativeWithSignModifier()
    {
        $segment = "{$this->airTemperature}/{$this->signModifier}{$this->dewPointTemperature}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->dewPointTemperature * -1, $data->getDewPointInCelsius());
    }

    public function testDewPointTemperatureInCelsiusWithOnlyAirTemperatureSignModifier()
    {
        $segment = "{$this->signModifier}{$this->airTemperature}/{$this->dewPointTemperature}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->dewPointTemperature, $data->getDewPointInCelsius());
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