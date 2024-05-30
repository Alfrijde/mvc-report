<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

/**
 * Test cases for the Entity GarbageMaterialKattegattOstersjon.
 */
class GarbageMaterialKattegattOstersjonTest extends TestCase
{
    public function testGarbageMaterialKattegattOstersjon()
    {
        $material = new GarbageMaterialKattegattOstersjon();
        $material->setMaterial('Plast');
        $material->setPercentage(72);



        $materialRepository = $this->createMock(ObjectRepository::class);

        $materialRepository->expects($this->any())
        ->method('find')
        ->willReturn($material);

        $material = $materialRepository
            ->find(1);

        $this->assertEquals('Plast', $material->getMaterial());
        $this->assertEquals(72, $material->getPercentage());

    }


}
