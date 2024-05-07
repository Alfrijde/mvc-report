<?php
/**
 * The DeckOfCards-class, contains objects of the CardGraphic-class.
 */

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{
    protected array $value;
    /**
     * Constructs the deck and creates a sorted deck containing CardGraphic-objects.
     */

    public function __construct()
    {
        $num = 52;

        $deck = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = new CardGraphic();
            $card->setValue($i);
            $deck[] = $card;
        }

        $this->value = $deck;

    }
    /**
     * Creates a shuffled deck containing CardGraphic-objects.
     * @return array<object>
     */

    public function shuffledDeck(): array
    {
        $num = 52;

        $randList = [];


        while (count($randList) < 52) {
            $value = rand(1, 52);
            if (in_array($value, $randList) == false) {
                $randList[] = $value;
            }
        }

        $deck = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = new CardGraphic();
            $card->setValue($randList[$i - 1]);
            $deck[] = $card;
        }

        $this->value = $deck;

        return $this->value;
    }
    /**
     * Draws cards from the top af the deck and returns the rest of the deck and the discarded cards as separate arrays in one array.
     * The default number of cards is one card.
     * @return array<array>
     */

    public function drawCards(int $num = 1): array
    {
        $deck = $this->value;
        $discard = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = array_shift($deck);
            $discard[] = $card;
        }

        $this->value = $deck;

        return [$this, $discard];

    }
    /**
     * Returns all the cards in the deck as an array of strings.
     * As the class contains objects of the CardGraphic-class the string is an utf-8 icon.
     * @return array<string>
     */

    public function getDeckAsString(): array
    {
        $deck = $this->value;
        $stringDeck = [];

        for ($i = 0; $i < count($deck); $i++) {
            $card = $deck[$i];
            $cardString = $card->getAsString();
            $stringDeck[] = $cardString;
        }

        return $stringDeck;

    }


}
