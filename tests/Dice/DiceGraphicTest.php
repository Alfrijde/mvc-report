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
        $res = $die->roll();

        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Tests the getAsString-function on the dice
     */
    public function testGetValueDice()
    {
        $die = new DiceGraphic();
        $res = $die->roll();

        $res = $die->getAsString();

        $this->assertIsString($res);
    }


}