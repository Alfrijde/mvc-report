<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;

;

class ApiCard extends AbstractController
{
    #[Route("/api/deck", name: "api_deck", methods: ['GET'])]
    public function apiDeck(
        SessionInterface $session
    ): Response {

        $deck = new DeckOfCards();

        $session->set("card_deck", $deck);

        $data = [
            "deck" => $deck
        ];


        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_shuffle", methods: ['POST'])]
    public function apiShuffle(
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");

        $deck->shuffledDeck();

        $session->set("card_deck", $deck);

        $data = [
            "deck" => $deck
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw/{num<\d+>}", name: "api_draw", methods: ['POST'])]
    public function drawCard(
        int $num,
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");

        if ($num > count($deck->value)) {
            throw new \Exception("Can not draw more cards than are left!");
        }

        $discard = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = array_shift($deck->value);
            $discard[] = $card;
        }

        $cardsLeft = count($deck->value);

        $session->set("card_deck", $deck);

        $data = [
            "discard" => $discard,
            "cards_left" => $cardsLeft,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;


    }

    #[Route("/api/deck/draw", name: "api_draw_one")]
    public function drawOne(SessionInterface $session): Response
    {
        $deck = $session->get("card_deck");

        $discard = [];

        $card = array_shift($deck->value);
        $discard[] = $card;


        $cardsLeft = count($deck->value);

        $session->set("card_deck", $deck);

        $data = [
            "discard" => $discard,
            "cards_left" => $cardsLeft,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/library/books', name: 'api_books')]
    public function showAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();


        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/library/book/{isbn}', name: 'api_isbn')]
    public function showDetails(
        BookRepository $bookRepository,
        string $isbn
    ): Response {

        $book = $bookRepository
            ->findOneByISBNField($isbn);

        $response = $this->json($book);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

}
