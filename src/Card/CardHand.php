<?php

namespace App\Card;

use App\Card\CardGraphic;
use App\Card\DeckOfCards;

class CardHand
{
    public function __construct()
    {
        $hand = [];

        $this-> value = $hand;
    }

    public function addToHand($card)
    {
        $hand = $this->value;
        array_push($hand, $card);
        $this-> value = $hand;
    }

    public function getHandAsString(): array
    {
        $hand = $this->value;
        $string_deck = [];

        for ($i = 0; $i < count($hand); $i++) {
            $card = $hand[$i];
            $card_string = $card->getAsString();
            $string_deck[] = $card_string;
        }

        return $string_deck;

    }

    public function countHand()
    {
        $hand = $this->value;
        $hand_string = $this->getHandAsString();
        $aces = array('🂡', '🂱', '🃁', '🃑');
        $total = 0;
        $if_aces = array_intersect($hand_string, $aces);

        for($i = 0; $i < count($hand); ++$i) {
            $value = $hand[$i]->getValue();
            $total = $total + $value;

        }

        if ($if_aces) {
            if (count($if_aces) === 1) {
                $total2 = $total + 13;

                if ($total2 <= 21) {
                    return $total2;
                }

                return $total;
            }

            if (count($if_aces) === 2) {
                $total1 = $total + 13;
                $total2 = $total + 13 + 13;

                if ($total2 <= 21) {
                    return $total2;
                } elseif ($total1 <= 21) {
                    return $total1;
                }

                return $total;
            }

            if (count($if_aces) === 3) {
                $total1 = $total + 13;
                $total2 = $total + 13 + 13;
                $total3 = $total + 13 + 13 + 13;

                if ($total3 <= 21) {
                    return $total3;
                } elseif ($total2 <= 21) {
                    return $total2;
                } elseif ($total1 <= 21) {
                    return $total1;
                }

                return $total;
            }
            if (count($if_aces) === 4) {
                $total1 = $total + 13;
                $total2 = $total + 13 + 13;
                $total3 = $total + 13 + 13 + 13;
                $total4 = $total + 13 + 13 + 13 + 13;

                if ($total4 <= 21) {
                    return $total4;
                } elseif ($total3 <= 21) {
                    return $total3;
                } elseif ($total2 <= 21) {
                    return $total2;
                } elseif ($total1 <= 21) {
                    return $total1;
                }

                return $total;
            }

        }

        return $total;

    }
}
