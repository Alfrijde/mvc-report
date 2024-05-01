<?php

namespace App\Card;

use App\Card\CardGraphic;
use App\Card\DeckOfCards;

class CardHand
{
    /**
 * @property array<mixed> $value
 */
    // @phpstan-ignore-next-line
    protected array $value;

    public function __construct()
    {
        $hand = [];

        $this->value = $hand;
    }

    public function addToHand(CardGraphic $card): void
    {
        $hand = $this->value;
        array_push($hand, $card);
        $this-> value = $hand;
    }
    /**
     * @return array<string>
     */

    public function getHandAsString(): array
    {
        $hand = $this->value;
        $stringDeck = [];
        $count = count($hand);

        for ($i = 0; $i < $count; $i++) {
            $card = $hand[$i];
            $cardString = $card->getAsString();
            $stringDeck[] = $cardString;
        }

        return $stringDeck;
    }

    public function countHand(): int
    {
        $hand = $this->value;
        $handString = $this->getHandAsString();
        $aces = array('🂡', '🂱', '🃁', '🃑');
        $total = 0;
        $ifAces = array_intersect($handString, $aces);
        $count = count($hand);

        for($i = 0; $i < $count; ++$i) {
            $value = $hand[$i]->getValue();
            $total = $total + $value;

        }

        if ($ifAces) {
            $acesCount = count($ifAces);
            if ($acesCount === 1) {
                $total2 = $total + 13;

                if ($total2 <= 21) {
                    return $total2;
                }

                return $total;
            }

            if ($acesCount === 2) {
                $total1 = $total + 13;
                $total2 = $total + 13 + 13;

                if ($total2 <= 21) {
                    return $total2;
                } elseif ($total1 <= 21) {
                    return $total1;
                }

                return $total;
            }

            if ($acesCount === 3) {
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
            if ($acesCount === 4) {
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
