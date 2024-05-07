<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    /**
     * Test the constructor and add card
     */
    public function testCardHandObject()
    {
        $hand = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        $card = new CardGraphic();

        $hand->addToHand($card);


        $res = $hand->getHandAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Test the getString-function af CardHand
     */
    public function testGetCardHandAsString()
    {
        $hand = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        $card = new CardGraphic();

        $hand->addToHand($card);


        $res = $hand->getHandAsString();
        $this->assertIsString($res[0]);

    }

    /**
     * Test the sum-function of CardHand.
     */
    public function testSumOfCarHand()
    {
        $hand = new CardHand();

        $card1 = $this->createMock(CardGraphic::class);
        $card2 = $this->createMock(CardGraphic::class);

        $card1->method('getValue')
            ->willReturn(8);
        $card1->method('getAsString')
            ->willReturn('🂨');
        $card2->method('getValue')
            ->willReturn(11);
        $card2->method('getAsString')
            ->willReturn('🃛');

        $hand->addToHand($card1);
        $hand->addToHand($card2);

        $res = $hand->countHand();

        $this->assertEquals(19, $res);
    }

    /**
     * Test Sum-function with ace and high card
     */
    public function testSumOfCarHandOneAceHigh()
    {
        $hand = new CardHand();

        $card1 = $this->createMock(CardGraphic::class);
        $card2 = $this->createMock(CardGraphic::class);

        $card1->method('getValue')
            ->willReturn(1);
        $card1->method('getAsString')
            ->willReturn('🂡');
        $card2->method('getValue')
            ->willReturn(11);
        $card2->method('getAsString')
            ->willReturn('🃛');

        $hand->addToHand($card1);
        $hand->addToHand($card2);

        $res = $hand->countHand();

        $this->assertEquals(12, $res);
    }


    /**
     * Test Sum-function with ace and low card
     */
    public function testSumOfCarHandOneAceLow()
    {
        $hand = new CardHand();

        $card1 = $this->createMock(CardGraphic::class);
        $card2 = $this->createMock(CardGraphic::class);

        $card1->method('getValue')
            ->willReturn(1);
        $card1->method('getAsString')
            ->willReturn('🂡');
        $card2->method('getValue')
            ->willReturn(3);
        $card2->method('getAsString')
            ->willReturn('🃃');

        $hand->addToHand($card1);
        $hand->addToHand($card2);

        $res = $hand->countHand();

        $this->assertEquals(17, $res);
    }
}
