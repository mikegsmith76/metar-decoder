<?php

namespace Tests\Metar\Parser\Segment;

use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;
use Metar\Parser\Segment\Visibility as VisibilitySegment;
use PHPUnit\Framework\TestCase;

/**
 * Class VisibilityTest
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Tests\Metar\Parser\Segment
 */
class VisibilityTest extends TestCase
{
    /**
     * @var string
     */
    protected $direction = "NE";

    /**
     * @var int
     */
    protected $horizontalInMetres = 8000;

    /**
     * @var VisibilitySegment
     */
    protected $segmentParser = null;

    /**
     *
     */
    public function setUp()
    {
        $this->segmentParser = new VisibilitySegment;
    }

    public function testHorizontalVisibility()
    {
        $segment = "{$this->horizontalInMetres}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->horizontalInMetres, $data->getHorizontalInMetres());
    }

    public function testHorizontalVisibilityWhenDirectionIsPresent()
    {
        $segment = "{$this->horizontalInMetres}{$this->direction}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->horizontalInMetres, $data->getHorizontalInMetres());
    }

    public function testDirection()
    {
        $segment = "{$this->horizontalInMetres}{$this->direction}";

        $data = $this->segmentParser->parse($segment);
        $this->assertSame($this->direction, $data->getDirection());
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