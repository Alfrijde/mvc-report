<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\Card;
use App\Card\CardGraphic;

class CardGameController extends AbstractController
{
    #[Route("/session", name: "session", methods: ['GET'])]
    public function session(
        SessionInterface $session
    ): Response {

        $session = $request->getSession();

        return $this->render('card/session.html.twig', $session);
    }

    #[Route("/session/delete", name: "session_delete", methods: ['POST'])]
    public function session_delete(
        SessionInterface $session
    ): Response {
        $this->get('session')->clear();

        $this->addFlash(
            'warning',
            'Nu är sessionen raderad'
        );

        return $this->redirectToRoute('card/session');

    }


    #[Route("/card", name: "card_init")]
    public function init(): Response
    {
        return $this->render('card/card.html.twig');
    }

    #[Route("/card/deck", name: "card_deck")]
    public function show_deck(): Response
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

        return $this->render('card/show_deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffle", name: "deck_shuffle")]
    public function shuffle_deck(
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

        return $this->render('card/show_deck.html.twig', $data);
    }

    #[Route("/card/deck/draw/{num<\d+>}", name: "draw")]
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

        return $this->render('card/discard.html.twig', $data);
    }

    #[Route("/card/deck/draw", name: "draw_one")]
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

        return $this->render('card/discard.html.twig', $data);
    }

}
