<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for class DiceGameController.
 */
class DiceGameControllerTest extends WebTestCase
/**
 * Tests if the init-page is loading
 */
{
    public function testInitPage(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('GET', '/game/pig/init');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Pig game');
    }


}
