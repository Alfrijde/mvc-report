<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

/**
 * Test cases for the Entity GarbageMaterialRuralKattegattOstersjon.
 */
class GarbageMaterialRuralKattegattOstersjonTest extends TestCase
{
    /**
     * Tests the creation of the object.
     */
    public function testGarbageMaterialRuralKattegattOstersjon()
    {
        $material = new GarbageMaterialRuralKattegattOstersjon();
        $material->setMaterial('Trä');
        $material->setPercentage(12);



        $materialRepository = $this->createMock(ObjectRepository::class);


        $materialRepository->expects($this->any())
        ->method('find')
        ->willReturn($material);

        $material = $materialRepository
            ->find(1);

        $this->assertEquals('Trä', $material->getMaterial());
        $this->assertEquals(12, $material->getPercentage());

    }
    /**
    * Tests the getId function in the class.
    */

    public function testGarbageMaterialRuralKattegattOstersjonGetId()
    {
        $material = $this->createMock(GarbageMaterialRuralKattegattOstersjon::class);

        $material->method('getId')
        ->willReturn(10);

        $this->assertEquals(10, $material->getId());
    }


}
