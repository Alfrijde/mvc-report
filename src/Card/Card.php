<?php
/**
 * The Card-class.
 */
namespace App\Card;

class Card
{
    protected int $value;
    /**
     * Creates a card with a random value between 1 and 52.
     */

    public function __construct()
    {
        $value = random_int(1, 52);

        $this->value = $value;
    }
    /**
     * Sets the value of the card to the desired number.
     */

    public function setValue(int $value): int
    {
        return $this->value = $value;
    }
    /**
     * Returns the value of the card.
     */

    public function getValue(): int
    {
        return $this->value;
    }
    /**
     * Returns the value of the card as a string.
     */

    public function getAsString(): string
    {
        return "[{$this->value}]";
    }
}
