<?php

namespace Muratsplat\ParesPHP\Test;

use Muratsplat\ParesPHP\Parser;
use PHPUnit\Framework\TestCase;

class ParesTest extends TestCase
{
    public function testFirst()
    {
        $this->assertTrue(true);
    }

    public function testNew()
    {
        return new Parser();
    }

    public function testParasResource()
    {
        $pares = file_get_contents("tests/testData/PARes.txt");
        return $pares;
    }

    /**
     * @depends testParasResource
     * @param $pares
     * @return Parser
     */
    public function testNewObj($pares)
    {
        return new Parser($pares);
    }

    /**
     * @depends testParasResource
     * @param $pares
     * @return Parser
     */
    public function testImport($pares)
    {
        return (new Parser())->import($pares);
    }

    /**
     * @depends testNewObj
     * @param $pares
     * @return Parser
     */
    public function testParse(Parser $parser)
    {
        $this->assertTrue($parser->parse());
        $dto = $parser->export();
        $this->assertSame(526571, $dto->getAcquirerBIN());
        $this->assertSame('02000000000', $dto->getMerchantID());
        $this->assertSame('MDAwMDAwMDAwMDEyMzQ1Njc4OTA=', $dto->getXID());
        $this->assertSame(21601, $dto->getAmount());
        $this->assertSame(208, $dto->getCurrency());
        $this->assertSame(2, $dto->getExponent());
        $this->assertSame('02', $dto->getTXECI());
        $this->assertSame('jI3JBkkaQ1p8CBAAABy0CHUAAAA=', $dto->getTXCAVV());
        $this->assertSame('Y', $dto->getTXStatus());
        $this->assertSame('3', $dto->getTXcavvAlgorithm());
        $this->assertSame('20150216 10:17:23', $dto->getTXTime());
        $this->assertSame('20150216 10:17:41', $dto->getDate());

    }


}