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

class ApiCard extends AbstractController
{
    #[Route("/api/deck", name: "api_deck")]
    public function apiDeck(): Response
    {
        $num = 52;

        $deck = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = new CardGraphic();
            $card->setValue($i);
            $deck[] = $card->getAsString();
        }

        $data = [
            "deck" => $deck
        ];


        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_shuffle")]
    public function api_shuffle(
        Request $request,
        SessionInterface $session
    ): Response {
        $num = 52;

        $rand_list = [];

        while (count($rand_list) < 52) {
            $value = rand(1, 52);
            if (in_array($value, $rand_list) == false) {
                $rand_list[] = $value;
            }
        }

        $deck = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = new CardGraphic();
            $card->setValue($rand_list[$i - 1]);
            $deck[] = $card->getAsString();
        }

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

    #[Route("/api/deck/draw/{num<\d+>}", name: "draw")]
    public function drawCard(
        int $num,
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");

        if ($num > count($deck)) {
            throw new \Exception("Can not draw more cards than are left!");
        }

        $discard = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = array_shift($deck);
            $discard[] = $card;
        }

        $cards_left = count($deck);

        $session->set("card_deck", $deck);

        $data = [
            "discard" => $discard,
            "cards_left" => $cards_left,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;

        
    }

    #[Route("/api/deck/draw", name: "draw_one")]
    public function drawOne(SessionInterface $session): Response
    {
        $deck = $session->get("card_deck");

        $discard = [];

        $card = array_shift($deck);
        $discard[] = $card;


        $cards_left = count($deck);

        $session->set("card_deck", $deck);

        $data = [
            "discard" => $discard,
            "cards_left" => $cards_left,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;

    
    }

}