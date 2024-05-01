<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Report extends AbstractController
{
    #[Route("/", name: "me")]
    public function showMe(): Response
    {


        return $this->render('me.html.twig');
    }

    #[Route("/about", name: "about")]
    public function home(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function about(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/lucky", name: "lucky")]
    public function number(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function api(): Response
    {
        return $this->render('api.html.twig');
    }

    #[Route("/api/quote", name: "quotes")]
    public function jsonQuote(): Response
    {
        date_default_timezone_set('CET');
        $qoutes = [
            "Lite snett ar också rakt",
            "Man ar som olika",
            "Det finns folk till allt"

        ];
        $num = random_int(0, 2);
        $date = date("Y-m-d H:i:s");


        $data = [
            'quote' => $qoutes[$num],
            'date' => $date,
        ];

        // return new JsonResponse($data);


        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }



}
