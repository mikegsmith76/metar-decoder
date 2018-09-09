<?php

namespace Tests\Metar\Parser\Segment;

use Metar\Parser\Segment\Exception\Invalid as InvalidDataException;
use Metar\Parser\Segment\CloudLayer as CloudLayerSegment;
use Metar\Parser\Data\Segment\CloudLayer as CloudLayerData;
use PHPUnit\Framework\TestCase;

/**
 * Class CloudLayerTest
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Tests\Metar\Parser\Segment
 */
class CloudLayerTest extends TestCase
{
    /**
     * @var CloudLayerSegment
     */
    protected $segmentParser = null;

    public function setUp()
    {
        $this->segmentParser = new CloudLayerSegment;
    }

    /**
     * Cloud coverage
     */

    public function testNoCloudCoverage()
    {
        $segment = CloudLayerData::COVERAGE_NONE . "001";

        $data = $this->segmentParser->parse($segment);
        $this->assertEquals(CloudLayerData::COVERAGE_NONE, $data->getCoverage());
    }

    public function testFewCloudCoverage()
    {
        $segment = CloudLayerData::COVERAGE_FEW . "001";

        $data = $this->segmentParser->parse($segment);
        $this->assertEquals(CloudLayerData::COVERAGE_FEW, $data->getCoverage());
    }

    public function testScatteredCloudCoverage()
    {
        $segment = CloudLayerData::COVERAGE_SCATTERED . "001";

        $data = $this->segmentParser->parse($segment);
        $this->assertEquals(CloudLayerData::COVERAGE_SCATTERED, $data->getCoverage());
    }

    public function testBrokenCloudCoverage()
    {
        $segment = CloudLayerData::COVERAGE_BROKEN . "001";

        $data = $this->segmentParser->parse($segment);
        $this->assertEquals(CloudLayerData::COVERAGE_BROKEN, $data->getCoverage());
    }

    public function testFullCloudCoverage()
    {
        $segment = CloudLayerData::COVERAGE_FULL . "001";

        $data = $this->segmentParser->parse($segment);
        $this->assertEquals(CloudLayerData::COVERAGE_FULL, $data->getCoverage());
    }

    /**
     * Cloud Height
     */

    public function testHeightInFeet()
    {
        $height = 8; // 800 feet
        $segment = CloudLayerData::COVERAGE_NONE . str_pad($height, 3, "0", STR_PAD_LEFT);

        $data = $this->segmentParser->parse($segment);
        $this->assertEquals($height * 100, $data->getHeightInFeet());
    }

    /**
     * Cloud Type
     */

    public function testCloudTypeWithToweringCumulus()
    {
        $segment = CloudLayerData::COVERAGE_FULL . "001" . CloudLayerData::TYPE_TOWERING_CUMULUS;

        $data = $this->segmentParser->parse($segment);

        $this->assertEquals(CloudLayerData::TYPE_TOWERING_CUMULUS, $data->getType());
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