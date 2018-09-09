<?php

namespace Tests\Metar\Parser\Segment;

use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;
use Metar\Parser\Segment\Airfield as AirfieldSegment;
use Metar\Parser\Data\Segment\Airfield as AirfieldData;
use PHPUnit\Framework\TestCase;

/**
 * Class AirfieldTest
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Tests\Metar\Parser\Segment
 */
class AirfieldTest extends TestCase
{
    protected $code = "EGCB";

    /**
     * @var AirfieldSegment
     */
    protected $segmentParser = null;

    public function setUp()
    {
        $this->segmentParser = new AirfieldSegment;
    }

    public function testCode()
    {
        $data = $this->segmentParser->parse($this->code);
        $this->assertSame($this->code, $data->getCode());
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