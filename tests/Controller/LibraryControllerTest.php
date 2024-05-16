<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Test cases for class LibraryController.
 */
class LibraryControllerTest extends WebTestCase

{
    /**
 * Tests if the library home page is loading.
 */
    public function testLibraryHomePage(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();
        

        // Request a specific page
        $client->request('GET', '/library');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Välkommen till biblioteket');
        

    }

//     /**
//  * Tests if all the books are displayed
//   */

//     public function testShowAllBooks(): void
//     {
//         // This calls KernelTestCase::bootKernel(), and creates a
//         // "client" that is acting as the browser
//         $client = static::createClient();
        

//         // Request a specific page
//         $client->request('GET', '/library/show');

//         // Validate a successful response and some content
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('table', 'The Hobbit');
//         $client->catchExceptions(false);
//     }
//         /**
//  * Tests if the specified book is displayed
//   */

//   public function testShowOneBook(): void
//   {
//       // This calls KernelTestCase::bootKernel(), and creates a
//       // "client" that is acting as the browser
//       $client = static::createClient();
      

//       // Request a specific page
//       $client->request('GET', '/library/show/1');

//       // Validate a successful response and some content
//       $this->assertResponseIsSuccessful();
//       $this->assertSelectorTextContains('table', 'The Hobbitses');
//       $client->catchExceptions(false);
//   }
}
