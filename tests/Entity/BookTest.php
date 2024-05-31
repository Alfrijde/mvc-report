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
        $book->setImage('/img/a_nice_cover.png');

        $bookRepository = $this->createMock(ObjectRepository::class);

        $bookRepository->expects($this->any())
        ->method('find')
        ->willReturn($book);

        $book = $bookRepository
            ->find(1);

        $this->assertEquals('Hästen och hans pojke', $book->getName());
        $this->assertEquals('123456789', $book->getISBN());
        $this->assertEquals('C.S. Lewis', $book->getAuthor());
        $this->assertEquals('/img/a_nice_cover.png', $book->getImage());

    }

    public function testBookGetId()
    {
        $book = $this->createMock(Book::class);

        $book->method('getId')
        ->willReturn(16);
        
        $bookRepository = $this->createMock(ObjectRepository::class);

        $bookRepository->expects($this->any())
        ->method('find')
        ->willReturn($book);

        $book = $bookRepository
            ->find(1);

        $this->assertEquals(16, $book->getId());
    }


}
