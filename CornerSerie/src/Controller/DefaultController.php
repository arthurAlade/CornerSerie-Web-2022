<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\FilmRepository;
use App\Repository\SerieRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'Homepage')]
    public function index(FilmRepository $filmRepository, SerieRepository $serieRepository, CategorieRepository $categorieRepository): Response
    {
        $films = $filmRepository->findAllbyRand(5);
        $series = $serieRepository->findAllByRandWithSaison(5, 1);
        $categoriesFilms = $categorieRepository->findAllCategoriesFilm();
        $categoriesSeries = $categorieRepository->findAllCategoriesSerie();
        return $this->render('default/index.html.twig', [
            'films' => $films,
            'series' => $series,
            'categoriesFilms' => $categoriesFilms,
            'categoriesSeries' => $categoriesSeries,
        ]);
    }


}
