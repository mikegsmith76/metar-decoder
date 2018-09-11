<?php

namespace Tests\Metar\Parser\Tokenizer;

use Metar\Parser\Segment\BaseSegment;
use Metar\Parser\Tokenizer\Regex as RegexTokenizer;
use PHPUnit\Framework\TestCase;

/**
 * Class RegexTest
 *
 * @author Mike Smith <mail@mikegsmith.co.uk>
 * @package Tests\Metar\Parser\Tokenizer
 */
class RegexTest extends TestCase
{
    protected $mockSegment = null;

    /**
     * @var RegexTokenizer
     */
    protected $tokenizer = null;

    /**
     * @var string
     */
    protected $sampleRegex = '/\b[A-Z]{4}\b/';

    public function setUp()
    {
        $this->mockSegment = $this->getMockSegment();
        $this->tokenizer = new RegexTokenizer;
    }

    public function testTokenizerCanRetrieveTokens()
    {
        $sampleToTokenize = "ABCD EFGH";

        $result = $this->tokenizer->getTokensForSegment($this->mockSegment, $sampleToTokenize);
        $this->assertSame(["ABCD", "EFGH"], $result->getTokens());
    }

    public function testTokenizerCanRetrieveTokensWhenOtherDataIsPresent()
    {
        $sampleToTokenize = "ABCD IJ";

        $result = $this->tokenizer->getTokensForSegment($this->mockSegment, $sampleToTokenize);
        $this->assertSame(["ABCD"], $result->getTokens());
    }

    public function testTokenizerReturnsRemainder()
    {
        $sampleToTokenize = 'ABCD IJ';

        $result = $this->tokenizer->getTokensForSegment($this->mockSegment, $sampleToTokenize);
        $this->assertSame("IJ", $result->getRemaining());
    }

    protected function getMockSegment()
    {
        $mock = $this
            ->getMockBuilder(BaseSegment::class)
            ->setMethods(['getTokenizationRegex', 'populateDataContainer'])
            ->getMock();

        $mock
            ->expects($this->any())
            ->method('getTokenizationRegex')
            ->will(
                $this->returnValue(
                    $this->sampleRegex
                )
            );

        return $mock;
    }
}