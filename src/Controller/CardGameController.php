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

class CardGameController extends AbstractController
{
    #[Route("/session", name: "session", methods: ['GET'])]
    public function session(
        Request $request,
        SessionInterface $session
    ): Response {

        $session = $request->getSession();

        $data = [
            "session" => $session
        ];

        return $this->render('card/session.html.twig', $data);
    }

    #[Route("/session/delete", name: "session_delete")]
    public function session_delete(
        SessionInterface $session
    ): Response {
        $session->clear();


        $this->addFlash(
            'warning',
            'Nu är sessionen raderad'
        );

        return $this->redirectToRoute('session');

    }


    #[Route("/card", name: "card_init")]
    public function init(
        SessionInterface $session
    ): Response {

        return $this->render('card/card.html.twig');
    }

    #[Route("/card/deck", name: "card_deck")]
    public function show_deck(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();

        $session->set("card_deck", $deck);

        $data = [
            "deck" => $deck->value
        ];

        return $this->render('card/show_deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffle", name: "deck_shuffle")]
    public function shuffle_deck(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();

        $deck->shuffledDeck();

        $session->set("card_deck", $deck);

        $data = [
            "deck" => $deck->value
        ];

        return $this->render('card/show_deck.html.twig', $data);
    }

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

        $cards_left = count($deck->value);

        $session->set("card_deck", $deck);

        $data = [
            "discard" => $discard,
            "cards_left" => $cards_left,
        ];

        return $this->render('card/discard.html.twig', $data);
    }

    #[Route("/card/deck/draw", name: "draw_one")]
    public function drawOne(SessionInterface $session): Response
    {
        $deck = $session->get("card_deck");

        $array = $deck->drawCards();

        $deck = $array[0];
        $discard = $array[1];

        $cards_left = count($deck->value);

        $session->set("card_deck", $deck);

        $data = [
            "discard" => $discard,
            "cards_left" => $cards_left,
        ];

        return $this->render('card/discard.html.twig', $data);
    }

}
