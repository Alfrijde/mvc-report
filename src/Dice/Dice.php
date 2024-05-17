<?php
/**
 * The dice Class
 */

namespace App\Dice;

class Dice
{
    protected $value;
    /**
     * Constructs a dice.
     */

    public function __construct()
    {
        $this->value = null;
    }
    /**
     * Rolls the die and sets a random value.
     * @return int
     */
    public function roll(): int
    {
        $this->value = random_int(1, 6);
        return $this->value;
    }
    /**
     * Returns the value of the die.
     * @return int
     */

    public function getValue(): int
    {
        return $this->value;
    }
    /**
     * Return the die value as a string.
     * @return string
     */
    public function getAsString(): string
    {
        return "[{$this->value}]";
    }
}
