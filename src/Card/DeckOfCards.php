<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{
    protected array $value;

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
     * @return array<array<object>>
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
