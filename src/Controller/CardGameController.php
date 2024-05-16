<?php
/**
 * The Card Game Controller.
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

class CardGameController extends AbstractController
{
    /**
     * Shows the current session.
     */
    #[Route("/session", name: "session", methods: ['GET'])]
    public function session(
        Request $request
    ): Response {

        $session = $request->getSession();

        $data = [
            "session" => $session
        ];

        return $this->render('card/session.html.twig', $data);
    }
    /**
     * Deletes the session.
     */

    #[Route("/session/delete", name: "session_delete")]
    public function sessionDelete(
        SessionInterface $session
    ): Response {
        $session->clear();


        $this->addFlash(
            'warning',
            'Nu är sessionen raderad'
        );

        return $this->redirectToRoute('session');

    }
/**
 * Initates the card game.
 */

    #[Route("/card", name: "card_init")]
    public function init(
    ): Response {

        return $this->render('card/card.html.twig');
    }

    #[Route("/card/deck", name: "card_deck")]
    public function showDeck(
        SessionInterface $session
    ): Response {
        $deckObjects = new DeckOfCards();
        $deck = $deckObjects->getDeckAsString();

        $session->set("card_deck", $deck);

        $data = [
            "deck" => $deck
        ];

        return $this->render('card/show_deck.html.twig', $data);
    }
/**
 * Shuffles the card deck.
 */
    #[Route("/card/deck/shuffle", name: "deck_shuffle")]
    public function shuffleDeck(
        SessionInterface $session
    ): Response {
        $deckObjects = new DeckOfCards();


        $deckObjects->shuffledDeck();
        $deck = $deckObjects->getDeckAsString();

        $session->set("card_deck", $deck);

        $data = [
            "deck" => $deck
        ];

        return $this->render('card/show_deck.html.twig', $data);
    }
/**
 * Draws the specified number of cards from the deck.
 */
    #[Route("/card/deck/draw/{num<\d+>}", name: "draw")]
    public function drawCard(
        int $num,
        SessionInterface $session
    ): Response {
        $deck = $session->get("card_deck");

        if ($num > count($deck->value)) {
            throw new \Exception("Can not draw more cards than are left!");
        }

        $array = $deck->drawCards($num);

        $deck = $array[0];
        $discard = $array[1];

        $cardsLeft = count($deck->value);

        $session->set("card_deck", $deck);

        $data = [
            "discard" => $discard,
            "cards_left" => $cardsLeft,
        ];

        return $this->render('card/discard.html.twig', $data);
    }
/**
 * Draws one card from the deck.
 */
    #[Route("/card/deck/draw", name: "draw_one")]
    public function drawOne(SessionInterface $session): Response
    {
        $deck = $session->get("card_deck");

        $array = $deck->drawCards();

        $deck = $array[0];
        $discard = $array[1];

        $cardsLeft = count($deck->value);

        $session->set("card_deck", $deck);

        $data = [
            "discard" => $discard,
            "cards_left" => $cardsLeft,
        ];

        return $this->render('card/discard.html.twig', $data);
    }

}
