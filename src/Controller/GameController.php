<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;
use App\Card\CardHand;

class GameController extends AbstractController
{
    #[Route("game/doc", name: "documentation")]
    public function doc(): Response
    {

        return $this->render('game/doc.html.twig');
    }
    #[Route("game/", name: "game_init")]
    public function init(
        SessionInterface $session
    ): Response {

        $deck = new DeckOfCards();
        $deck->shuffledDeck();

        $player_hand = new CardHand();
        $bank_hand = new CardHand();

        $session->set("card_deck", $deck);
        $session->set("player_hand", $player_hand);
        $session->set("bank_hand", $bank_hand);


        return $this->render('game/init.html.twig');
    }

    #[Route("game/play", name: "game_play", methods: ['GET'])]
    public function play(
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");
        $player_hand = $session->get("player_hand");

        $player_sum = $player_hand->countHand();

        $player_string = $player_hand->getHandAsString();

        $session->set("card_deck", $deck);
        $session->set("player_hand", $player_hand);


        $data = [
            "player_hand" => $player_string,
            "player_sum" => $player_sum
        ];

        return $this->render('game/play.html.twig', $data);
    }

    #[Route("game/draw", name: "game_draw", methods: ['GET'])]
    public function draw(
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");
        $player_hand = $session->get("player_hand");

        $array = $deck->drawCards();

        $deck = $array[0];
        $player_card = $array[1];

        $player_hand->addToHand($player_card[0]);

        $player_sum = $player_hand->countHand();

        $player_string = $player_hand->getHandAsString();

        $session->set("card_deck", $deck);
        $session->set("player_hand", $player_hand);


        $data = [
            "player_hand" => $player_string,
            "player_sum" => $player_sum
        ];

        return $this->render('game/play.html.twig', $data);
    }

    #[Route("game/bank", name: "game_bank", methods: ['GET'])]
    public function bank(
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");
        $bank_hand = $session->get("bank_hand");

        $bank_sum = $bank_hand->countHand();

        while ($bank_sum < 17) {
            $array = $deck->drawCards();

            $deck = $array[0];
            $bank_card = $array[1];

            $bank_hand->addToHand($bank_card[0]);

            $bank_sum = $bank_hand->countHand();

        }

        $session->set("card_deck", $deck);
        $session->set("bank_hand", $bank_hand);


        return $this->redirectToRoute('game_end');
    }

    #[Route("game/end", name: "game_end", methods: ['GET'])]
    public function end(
        SessionInterface $session
    ): Response {
        $player_hand = $session->get("player_hand");
        $bank_hand = $session->get("bank_hand");

        $bank_sum = $bank_hand->countHand();
        $player_sum = $player_hand->countHand();

        $player_string = $player_hand->getHandAsString();
        $bank_string = $bank_hand->getHandAsString();

        $data = [
            "player_hand" => $player_string,
            "player_sum" => $player_sum,
            "bank_hand" => $bank_string,
            "bank_sum" => $bank_sum
        ];

        return $this->render('game/end.html.twig', $data);
    }

}
