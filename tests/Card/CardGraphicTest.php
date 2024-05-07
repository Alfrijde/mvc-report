<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Test creates CardGraphic
     */
    public function testCreateCard()
    {
        $card = new CardGraphic();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $res = $card->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Tests the getAsString-functions of CardGraphic
     */
    public function testGet()
    {
        $card = new CardGraphic();

        $res = $card->getAsString();

        $this->assertIsString($res);
    }

    /**
     * Tests the getValue in CardGraphic
     */
    public function testGetString()
    {
        $card = new CardGraphic();
        $res = $card->getValue();

        $this->assertTrue($res >= 1);
        $this->assertTrue($res <= 13);

    }
}
