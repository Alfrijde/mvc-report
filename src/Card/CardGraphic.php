<?php
/**
 * The CardGraphic class. Extends the Card-class and creates a representation with a card and a value of that card
 */
namespace App\Card;

class CardGraphic extends Card
{
    /**
 * @property string $representation
 * @property int $numberValue
 * @property int $value
 */
    /**
     * All the graphics of a card deck.
     * @param array<string> $representation
     */
    // @phpstan-ignore-next-line
    private $representation = [
        '🂡', '🂢', '🂣', '🂤', '🂥', '🂦', '🂧', '🂨', '🂩', '🂪', '🂫', '🂭', '🂮',
        '🂱', '🂲', '🂳', '🂴', '🂵', '🂶', '🂷', '🂸', '🂹', '🂺', '🂻', '🂽', '🂾',
        '🃁', '🃂', '🃃', '🃄', '🃅', '🃆', '🃇', '🃈', '🃉', '🃊', '🃋', '🃍', '🃎',
        '🃑', '🃒', '🃓', '🃔', '🃕', '🃖', '🃗', '🃘', '🃙', '🃚', '🃛', '🃝', '🃞'
    ];
    /**
     * All values of a card deck.
 * @param array<int> $numberValue
 */
    // @phpstan-ignore-next-line
    private $numberValue = [
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13
    ];
/**
 * Constructs the object of the class.
 */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Returns a string with the graphic card.
     */

    public function getAsString(): string
    {
        return $this->representation[$this->value - 1];
    }
    /**
     * Returns the cards value as an int.
     */

    public function getValue(): int
    {
        return $this->numberValue[$this->value - 1];
    }
}
