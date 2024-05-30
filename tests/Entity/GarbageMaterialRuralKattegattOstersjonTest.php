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


}
