<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards 
{
    public function __construct()
    {
        $num = 52;

        $deck = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = new CardGraphic();
            $card->setValue($i);
            $deck[] = $card->getAsString();
        }

        $this->value = $deck;

    }

    public function shuffledDeck(): array
    {
        $num = 52;

        $rand_list = [];

        while (count($rand_list) < 52) {
            $value = rand(1, 52);
            if (in_array($value, $rand_list) == false) {
                $rand_list[] = $value;
            }
        }

        $deck = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = new CardGraphic();
            $card->setValue($rand_list[$i - 1]);
            $deck[] = $card->getAsString();
        }

        $this->value = $deck;

        return $this->value;
    }

    public function drawCards($num = 1) : array
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

    public function deckToArray() : array
    {

    }

}