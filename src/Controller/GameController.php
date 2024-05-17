<?php
/**
 * The game controller for the game 21.
 */

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
    /**
     * Shows the rules to the game and is the games homepage.
     */
    #[Route("game/doc", name: "documentation")]
    public function doc(): Response
    {

        return $this->render('game/doc.html.twig');
    }
    /**
     * Initiates the game and saves the deck and the cardhands to the session.
     */
    #[Route("game/", name: "game_init")]
    public function init(
        SessionInterface $session
    ): Response {

        $deck = new DeckOfCards();
        $deck->shuffledDeck();

        $playerHand = new CardHand();
        $bankHand = new CardHand();

        $session->set("card_deck", $deck);
        $session->set("player_hand", $playerHand);
        $session->set("bank_hand", $bankHand);


        return $this->render('game/init.html.twig');
    }
    /**
     * The play part of the game.
     */

    #[Route("game/play", name: "game_play", methods: ['GET'])]
    public function play(
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");
        $playerHand = $session->get("player_hand");

        $playerSum = $playerHand->countHand();

        $playerString = $playerHand->getHandAsString();

        $session->set("card_deck", $deck);
        $session->set("player_hand", $playerHand);


        $data = [
            "player_hand" => $playerString,
            "player_sum" => $playerSum
        ];

        return $this->render('game/play.html.twig', $data);
    }
    /**
     * Draws a card from the deck and saves iit to the card hand.
     */
    #[Route("game/draw", name: "game_draw", methods: ['GET'])]
    public function draw(
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");
        $playerHand = $session->get("player_hand");

        $array = $deck->drawCards();

        $deck = $array[0];
        $playerCard = $array[1];

        $playerHand->addToHand($playerCard[0]);

        $playerSum = $playerHand->countHand();

        $playerString = $playerHand->getHandAsString();

        $session->set("card_deck", $deck);
        $session->set("player_hand", $playerHand);


        $data = [
            "player_hand" => $playerString,
            "player_sum" => $playerSum
        ];

        return $this->render('game/play.html.twig', $data);
    }
    /**
     * This route manages the bank player of the game.
     */

    #[Route("game/bank", name: "game_bank", methods: ['GET'])]
    public function bank(
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");
        $bankHand = $session->get("bank_hand");

        $bankSum = $bankHand->countHand();

        while ($bankSum < 17) {
            $array = $deck->drawCards();

            $deck = $array[0];
            $bankCard = $array[1];

            $bankHand->addToHand($bankCard[0]);

            $bankSum = $bankHand->countHand();

        }

        $session->set("card_deck", $deck);
        $session->set("bank_hand", $bankHand);


        return $this->redirectToRoute('game_end');
    }
    /**
     * Sums up the game and all scores.
     */
    #[Route("game/end", name: "game_end", methods: ['GET'])]
    public function end(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("player_hand");
        $bankHand = $session->get("bank_hand");

        $bankSum = $bankHand->countHand();
        $playerSum = $playerHand->countHand();

        $playerString = $playerHand->getHandAsString();
        $bankString = $bankHand->getHandAsString();

        $data = [
            "player_hand" => $playerString,
            "player_sum" => $playerSum,
            "bank_hand" => $bankString,
            "bank_sum" => $bankSum
        ];

        return $this->render('game/end.html.twig', $data);
    }

}
