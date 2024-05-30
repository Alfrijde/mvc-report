<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
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
    public function configureAssets(): Assets
    {
        $assets = parent::configureAssets();

        $assets->addWebpackEncoreEntry('app');

        return $assets;
    }
    #[Route("/proj", name: "project")]
    public function showProject(): Response
    {
        return $this->render('project/start-project.html.twig');
    }

    #[Route("/proj/about", name: "project_about")]
    public function aboutProject(): Response
    {
        return $this->render('project/about.html.twig');
    }

    #[Route("/sustainability", name: "sustainability")]
    public function sustainability(): Response
    {
        return $this->render('project/start-project.html.twig');
    }

        /**
     * Route for adding info to the database.
     */
    #[Route('/proj/add', name: 'project_add')]
    public function createEnrty(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $material = new GarbageMaterialRuralKattegattOstersjon();

        $form = $this->createForm(GarbageMaterialRuralFormType::class, $material);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();


            $entityManager->persist($material);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('project_add');
        }

        return $this->render('project/add.html.twig', [
            'form' => $form,
        ]);
    }

        /**
     * Route for showing all entries in the database.
     */

     #[Route('/proj/show/garbage', name: 'project_show_garbage')]
     public function showAllData(
        GarbageBeachKattegattOstersjonRepository $garbageRepository,
        GarbageMaterialKattegattOstersjonRepository $materialRepository,
        GarbageMaterialRuralKattegattOstersjonRepository $materialRuralRepository,
        ChartBuilderInterface $chartBuilder
     ): Response {
         $years = $garbageRepository
             ->findAll();

        $materials = $materialRepository
        ->findAll();
        
        $materialsRural = $materialRuralRepository
        ->findAll();

        $labels = [];
        $datasets1 = [];
        $datasets2 = [];

        foreach($years as $data){
            $labels[] = $data->getyear();
            $datasets1[] = $data->getUrbanBeach();
            $datasets2[] = $data->getRuralBeach();
        }

        $labelsUrban = [];
        $datasetsUrban = [];

        foreach($materials as $data){
            $labelsUrban[] = $data->getMaterial();
            $datasetsUrban[] = $data->getPercentage();
            
        }

        foreach($materialsRural as $data){
            $labelsRural[] = $data->getMaterial();
            $datasetsRural[] = $data->getPercentage();
            
        }

 
         return $this->render('project/show_garbage.html.twig', [
             'years' => $years,
             'materials' => $materials,
             'materialsRural' => $materialsRural,
             'labels' => $labels,
             'datasets1' => $datasets1,
             'datasets2' => $datasets2,
             'labelsUrban' => $labelsUrban,
             'datasetsUrban' => $datasetsUrban,
             'labelsRural' => $labelsRural,
             'datasetsRural' => $datasetsRural


         ]);
     }
}