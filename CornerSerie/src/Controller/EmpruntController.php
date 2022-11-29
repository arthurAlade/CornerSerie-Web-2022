<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Entity\EmpruntFilm;
use App\Repository\EmpruntFilmRepository;
use App\Repository\EmpruntSerieSaisonRepository;
use App\Repository\FilmRepository;
use App\Repository\SaisonRepository;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt', name: 'app_emprunt')]
    //#[IsGranted('ROLE_USER')]
    public function index(CategorieRepository $categorieRepository, EmpruntFilmRepository $empruntFilmRepository, EmpruntSerieSaisonRepository $empruntSerieSaisonRepository): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        $categoriesFilms = $categorieRepository->findAllCategoriesFilm();
        $categoriesSeries = $categorieRepository->findAllCategoriesSerie();

        return $this->render('emprunts/emprunts.html.twig', [
            'categoriesFilms' => $categoriesFilms,
            'categoriesSeries' => $categoriesSeries,
        ]);
    }

}
