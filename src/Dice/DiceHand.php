<?php
/**
 * The DiceHand Class
 */

namespace App\Dice;

use App\Dice\Dice;

class DiceHand
{
    private $hand = [];
    /**
     * Adds dice to the dice hand.
     */

    public function add(Dice $die): void
    {
        $this->hand[] = $die;
    }

    /**
     * Rolls all the dice in the dice hand.
     */
    public function roll(): void
    {
        foreach ($this->hand as $die) {
            $die->roll();
        }
    }
    /**
     * Returns how many dice is in the hand.
     * @return int
     */

    public function getNumberDices(): int
    {
        return count($this->hand);
    }
    /**
     * Returns all the values of the dice in the dice hand.
     * @return array
     */

    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getValue();
        }
        return $values;
    }
    /**
     * Sums upp all the values of the dice in the dice hand.
     * @return int
     */

    public function sum(): int
    {
        $sum = 0;
        foreach ($this->hand as $die) {
            $sum += $die->getValue();
        }
        return $sum;
    }
    /**
     * Return all the dice as strings in an array.
     * @return array
     */

    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getAsString();
        }
        return $values;
    }
}
