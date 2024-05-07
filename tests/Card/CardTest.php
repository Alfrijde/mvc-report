<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;


/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Test creates card
     */
    public function testCreateCard()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Tests the get- and set-functions of Card
     */
    public function testGetAndSet()
     {
        $card = new Card();

        $res1 = $card->setValue(5);
        $res2 = $card->getValue();

        $this->assertEquals($res1, $res2);
    }
}