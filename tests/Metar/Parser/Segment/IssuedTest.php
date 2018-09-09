<?php

namespace Tests\Metar\Parser\Segment;

use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;
use Metar\Parser\Segment\Issued as IssuedSegment;
use PHPUnit\Framework\TestCase;

/**
 * Class IssuedTest
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Tests\Metar\Parser\Segment
 */
class IssuedTest extends TestCase
{
    /**
     * @var int
     */
    protected $dayOfMonth = 5;

    /**
     * @var int
     */
    protected $hour = 11;

    /**
     * @var int
     */
    protected $minute = 35;

    /**
     * @var string
     */
    protected $segment = "";

    /**
     * @var IssuedSegment
     */
    protected $segmentParser = null;

    /**
     *
     */
    public function setUp()
    {
        $this->segmentParser = new IssuedSegment;

        $this->segment = ""
            . str_pad($this->dayOfMonth, 2, "0", STR_PAD_LEFT)
            . str_pad($this->hour, 2, "0", STR_PAD_LEFT)
            . str_pad($this->minute, 2, "0", STR_PAD_LEFT)
            . "Z";
    }

    public function testDayOfMonth()
    {
        $data = $this->segmentParser->parse($this->segment);
        $this->assertEquals($this->dayOfMonth, $data->getDayOfMonth());
    }

    public function testHour()
    {
        $data = $this->segmentParser->parse($this->segment);
        $this->assertEquals($this->hour, $data->getHour());
    }

    public function testMinute()
    {
        $data = $this->segmentParser->parse($this->segment);
        $this->assertEquals($this->minute, $data->getMinute());
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