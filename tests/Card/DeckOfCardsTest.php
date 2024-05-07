<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;


/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCardsTest extends TestCase
{
    /**Test the shuffle-function */
    public function testDeckOfCardsCreateAndShuffle()
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        $res1 = $deck->getDeckAsString();

        $deck->shuffledDeck();

        $res2 = $deck->getDeckAsString();

        $this-> assertNotEquals($res1, $res2);

    }

    /**
     * Test the draw card-function with no arguments.
     */
    public function testDrawCardsNoArgs()
    {
        $deck = new DeckOfCards();

        $array = $deck->drawCards();

        $drawnCard = $array[1];

        $this->assertEquals(1, count($drawnCard));
    }

        /**
     * Test the draw card-function with arguments.
     */
    public function testDrawCardsWithArgs()
    {
        $deck = new DeckOfCards();

        $array = $deck->drawCards(5);

        $drawnCard = $array[1];

        $this->assertEquals(5, count($drawnCard));
    }
}