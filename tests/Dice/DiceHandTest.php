<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;


/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Stub the dices to assure the value can be asserted.
     */
    public function testAddStubbedDices()
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);
        $stub->method('getValue')
            ->willReturn(6);

        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->roll();
        $res = $dicehand->sum();
        $this->assertEquals(12, $res);
    }

    /**
     * Test the getNumberDices-function, that it returns an int.
     */
    public function testNumberDice() 
    {        
        $stub = $this->createMock(Dice::class);
        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $res = $dicehand->getNumberDices();
        $this->assertEquals(1, $res);

    }

        /**
     * Stub the dices to assure the value can be asserted.
     */
    public function testGetAllValuesOfDice()
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);
        $stub->method('getValue')
            ->willReturn(6);

        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->roll();
        $res = $dicehand->getValues();
        $this->assertEquals([6,6], $res);
    }

            /**
     * Stub the dices to assure the value can be asserted.
     */
    public function testGetAllStringsOfDice()
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);
        $stub->method('getAsString')
            ->willReturn('6');

        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->roll();
        $res = $dicehand->getString();
        $this->assertEquals(['6','6'], $res);
    }

    
}