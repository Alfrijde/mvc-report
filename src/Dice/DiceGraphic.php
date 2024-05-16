<?php
/**
 * The DiceGraphic Class.
 */

namespace App\Dice;

class DiceGraphic extends Dice
{
    private $representation = [
        '⚀',
        '⚁',
        '⚂',
        '⚃',
        '⚄',
        '⚅',
    ];
    /**
     * Creates a DiceGraphic object.
     */

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Returns a string containing a UTF-8 icon.
     * @return string
     */

    public function getAsString(): string
    {
        return $this->representation[$this->value - 1];
    }
}
