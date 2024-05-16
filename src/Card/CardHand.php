<?php
/**
 * The CardHand-class. Contains objects of the cardGraphic-class to create a card hand for a player.
 */

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
    /**
     * Creates an empty hand. No cards are added from the beginning, they must be added via another method.
     */

    public function __construct()
    {
        $hand = [];

        $this->value = $hand;
    }
    /**
     * Adds a card to the hand. Tha card is an object of the CardGraphic-class.
     * Cards are added to the back of the array that is the hand.
     */

    public function addToHand(CardGraphic $card): void
    {
        $hand = $this->value;
        array_push($hand, $card);
        $this-> value = $hand;
    }
    /**
     * Returns the hand as an array containing graphics of the cards as a string.
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
    /**
     * Counts the sum of all the cards in the hand and returns sum.
     * If the hand contains aces to sums are made and compared and the more favourable sum is returned.
     * @return int
     */

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

        if (! empty($ifAces)) {
            $total2 = $total + 13;

            if ($total2 <= 21) {
                return $total2;
            }

            return $total;
        }

        return $total;

    }
}
