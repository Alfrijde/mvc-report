<?php

namespace App\Card;

class Card
{
    protected int $value;

    public function __construct()
    {
        $value = random_int(1, 52);

        $this->value = $value;
    }

    public function setValue(int $value): int
    {
        return $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getAsString(): string
    {
        return "[{$this->value}]";
    }
}
