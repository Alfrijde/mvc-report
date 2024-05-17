<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Test cases for class DiceGameController.
 */
class DiceGameControllerTest extends WebTestCase
{
    /**
 * Tests if the init-page is loading
 */
    public function testInitPage(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();


        // Request a specific page
        $client->request('GET', '/game/pig/init');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Pig game');

    }

    /**
 * Tests if the roll function works
  */

    public function testPigRoll(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();


        // Request a specific page
        $client->request('GET', '/game/pig/test/roll/2');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'You rolled 2 dices. Here is the value of the dices.');
        #$client->catchExceptions(false);
    }

    /**
 * Tests if the roll function works with a hand
  */

    public function testPigRollHand(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();


        // Request a specific page
        $client->request('GET', '/game/pig/test/dicehand/5');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'You rolled 5 dices. Here is the value of the dices.');
        #$client->catchExceptions(false);
    }


}
