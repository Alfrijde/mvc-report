<?php
/**
 * The controller of the project-part of the website.
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\GarbageBeachKattegattOstersjon;
use App\Form\BeachGarbageFormType;
use App\Repository\GarbageBeachKattegattOstersjonRepository;
use App\Entity\GarbageMaterialKattegattOstersjon;
use App\Form\GarbageMaterialFormType;
use App\Repository\GarbageMaterialKattegattOstersjonRepository;
use App\Entity\GarbageMaterialRuralKattegattOstersjon;
use App\Form\GarbageMaterialRuralFormType;
use App\Repository\GarbageMaterialRuralKattegattOstersjonRepository;

class ProjectController extends AbstractController
{
    /**
     * Route for the homepage for the project.
     */
    #[Route("/proj", name: "project")]
    public function showProject(): Response
    {
        return $this->render('project/start-project.html.twig');
    }
    /**
     * Route that show information about the project.
     */
    #[Route("/proj/about", name: "project_about")]
    public function aboutProject(): Response
    {
        return $this->render('project/about.html.twig');
    }

    /**
     * Route for adding info to the database.
     */
    // #[Route('/proj/add', name: 'project_add')]
    // public function createEnrty(
    //     ManagerRegistry $doctrine,
    //     Request $request
    // ): Response {
    //     $material = new GarbageMaterialRuralKattegattOstersjon();

    //     $form = $this->createForm(GarbageMaterialRuralFormType::class, $material);

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $doctrine->getManager();


    //         $entityManager->persist($material);

    //         // actually executes the queries (i.e. the INSERT query)
    //         $entityManager->flush();

    //         return $this->redirectToRoute('project_add');
    //     }

    //     return $this->render('project/add.html.twig', [
    //         'form' => $form,
    //     ]);
    // }

    /**
     * Route for showing garbage of beach.
     */

    #[Route('/proj/show/garbage', name: 'project_show_garbage')]
    public function showGarbage(
        GarbageBeachKattegattOstersjonRepository $garbageRepository,
    ): Response {
        $years = $garbageRepository
            ->findAll();

        $labels = [];
        $datasets1 = [];
        $datasets2 = [];

        foreach($years as $data) {
            $labels[] = $data->getyear();
            $datasets1[] = $data->getUrbanBeach();
            $datasets2[] = $data->getRuralBeach();
        }

        return $this->render('project/show_garbage.html.twig', [
            'years' => $years,
            'labels' => $labels,
            'datasets1' => $datasets1,
            'datasets2' => $datasets2,

        ]);
    }
    /**
     * Route for showing the material of the garbage.
     */

    #[Route('/proj/show/material', name: 'project_show_material')]
    public function showMaterial(
        GarbageMaterialKattegattOstersjonRepository $materialRepository,
        GarbageMaterialRuralKattegattOstersjonRepository $materialRuralRepository
    ): Response {


        $materials = $materialRepository
        ->findAll();

        $materialsRural = $materialRuralRepository
        ->findAll();

        $labelsUrban = [];
        $datasetsUrban = [];

        foreach($materials as $data) {
            $labelsUrban[] = $data->getMaterial();
            $datasetsUrban[] = $data->getPercentage();

        }

        $labelsRural = [];
        $datasetsRural = [];

        foreach($materialsRural as $data) {
            $labelsRural[] = $data->getMaterial();
            $datasetsRural[] = $data->getPercentage();

        }


        return $this->render('project/show_material.html.twig', [
            'materials' => $materials,
            'materialsRural' => $materialsRural,
            'labelsUrban' => $labelsUrban,
            'datasetsUrban' => $datasetsUrban,
            'labelsRural' => $labelsRural,
            'datasetsRural' => $datasetsRural
        ]);
    }
}
