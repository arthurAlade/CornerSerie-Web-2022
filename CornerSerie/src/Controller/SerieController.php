<?php

namespace App\Controller;

use App\Entity\EmpruntSerieSaison;
use App\Repository\CategorieRepository;
use App\Repository\SerieRepository;
use DateInterval;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/series', name: 'series')]
    public function index(CategorieRepository $categorieRepository, SerieRepository $serieRepository): Response
    {
        $series = $serieRepository->findAllWithSaison();

        $categoriesFilms = $categorieRepository->findAllCategoriesFilm();
        $categoriesSeries = $categorieRepository->findAllCategoriesSerie();


        return $this->render('serie/indexSerie.html.twig', [
            'series' => $series,
            'categoriesFilms' => $categoriesFilms,
            'categoriesSeries' => $categoriesSeries,
        ]);
    }

    #[Route('/series/{categorie}', name:'seriesCategorie')]
    public function seriesByCategorie(string $categorie, SerieRepository $serieRepository, CategorieRepository $categorieRepository): Response
    {
        $series = $serieRepository->findByCategorieWithSaison($categorie);

        $categoriesFilms = $categorieRepository->findAllCategoriesFilm();

        $categoriesSeries = $categorieRepository->findAllCategoriesSerie();
        return $this->render('serie/indexSerie.html.twig', [
            'series' => $series,

            'categoriesFilms' => $categoriesFilms,
            'categoriesSeries' => $categoriesSeries,
        ]);
    }

    #[Route('/serie/{id}/{saison}', name: 'serie')]
    public function serie(int $id, int $saison, SerieRepository $serieRepository, CategorieRepository $categorieRepository, Request $request, ManagerRegistry $doctrine){
        $serie = $serieRepository->findOneByIdWithSaison($id, $saison);
        $saison = $serie->getSaisons();

        $realisateurs = $this->getPersonnes($serie->getRealisateurs());
        $acteurs = $this->getPersonnes($serie->getActeurs());
        $categoriesFilms = $categorieRepository->findAllCategoriesFilm();

        $categoriesSeries = $categorieRepository->findAllCategoriesSerie();

        if ($this->getUser()) {
            $emprunt = new EmpruntSerieSaison();
            $emprunt->setSaison($saison[0]);
            $emprunt->setActif(true);
            $dateDebut= new \DateTime();

            $emprunt->setDateDebut($dateDebut);

            $dateInterval = new DateInterval('P7D');
            $dateFin = $dateDebut->add($dateInterval);

            $emprunt->setDateFin($dateFin);
            $emprunt->setUtilisateur($this->getUser());
            $emprunt->setRestituer(false);

            $form = $this->createFormBuilder($emprunt)
                ->add('Emprunter', SubmitType::class, ['label' => 'Emprunter'])
                ->getForm();

        }else{$form = null; }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($emprunt);
            $em->flush();
        }
        return $this->render('serie/serie.html.twig', [
            'serie' => $serie,
            'acteurs' => $acteurs,
            'realisateurs' => $realisateurs,
            'categoriesFilms' => $categoriesFilms,
            'categoriesSeries' => $categoriesSeries,
            'form' => $form->createView()
        ]);
    }

    public function getPersonnes($liste): string
    {
        $personnes = "";
        foreach ($liste as $personne){

            $personnes = $personne->getPrenom().' '.$personne->getNom().' / '.$personnes;
        }
        return $personnes;
    }
}
