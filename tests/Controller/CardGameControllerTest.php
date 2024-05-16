<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Test cases for class DiceGameController.
 */
class CardGameControllerTest extends WebTestCase

{
    /**
 * Tests if the show deck page is loading.
 */
    public function testDeckPage(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();
        

        // Request a specific page
        $client->request('GET', '/card/deck');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hela kortleken');
    }

    /**
 * Tests if the deck is displayed
  */

    public function testDeckShuffle(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();
        

        // Request a specific page
        $client->request('GET', '/card/deck/shuffle');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Här är kortleken:');
        #$client->catchExceptions(false);
    }
}
