<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

/**
 * Test cases for the Entity GarbageBeachKattegattOstersjon.
 */
class GarbageBeachKattegattOstersjonTest extends TestCase
{
    /**
     * Tests the creation of the object.
     */
    public function testGarbageBeachKattegattOstersjon()
    {
        $garbage = new GarbageBeachKattegattOstersjon();
        $garbage->setYear(1988);
        $garbage->setUrbanBeach(200);
        $garbage->setRuralBeach(100);


        $garbageRepository = $this->createMock(ObjectRepository::class);

        $garbageRepository->expects($this->any())
        ->method('find')
        ->willReturn($garbage);

        $garbage = $garbageRepository
            ->find(1);

        $this->assertEquals(1988, $garbage->getYear());
        $this->assertEquals(200, $garbage->getUrbanBeach());
        $this->assertEquals(100, $garbage->getRuralBeach());
    }
    /**
    * Tests the getId function in the class.
    */
    public function testGarbageBeachKattegattOstersjonGetId()
    {
        $garbage = $this->createMock(GarbageBeachKattegattOstersjon::class);

        $garbage->method('getId')
        ->willReturn(7);

        $this->assertEquals(7, $garbage->getId());
    }


}
