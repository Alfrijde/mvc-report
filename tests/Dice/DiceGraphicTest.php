<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDiceGraphic()
    {
        $die = new DiceGraphic();
        $this->assertInstanceOf("\App\Dice\DiceGraphic", $die);
        $res1 = $die->roll();

        $res2 = $die->getAsString();
        $this->assertNotEmpty($res2);
    }

    /**
     * Tests the getAsString-function on the dice
     */
    public function testGetValueDice()
    {
        $die = new DiceGraphic();
        $res1 = $die->roll();
        $res2 = $die->getAsString();
        $this->assertIsString($res2);
    }


}
