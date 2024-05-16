<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

/**
 * Test cases for the Entity Book.
 */
class BookTest extends TestCase

{
    public function testBook()
    {
        $book = new Book();
        $book->setName('Hästen och hans pojke');
        $book->setISBN('123456789');
        $book->setAuthor('C.S. Lewis');

        $bookRepository = $this->createMock(ObjectRepository::class);

        $bookRepository->expects($this->any())
        ->method('find')
        ->willReturn($book);

        $book = $bookRepository
            ->find(1);

        $this->assertEquals('Hästen och hans pojke', $book->getName());
        $this->assertEquals('123456789', $book->getISBN());
        $this->assertEquals('C.S. Lewis', $book->getAuthor());

    }


}