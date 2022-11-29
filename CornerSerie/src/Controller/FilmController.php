<?php

namespace App\Controller;

use App\Entity\EmpruntFilm;
use App\Repository\CategorieRepository;
use App\Repository\FilmRepository;
use DateInterval;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/film/{id}', name: 'film', requirements: ['id'=>'[1-9]\d*'])]
    public function film(Request $request, int $id, FilmRepository $filmRepository, CategorieRepository $categorieRepository, ManagerRegistry $doctrine): Response
    {

        $film = $filmRepository->find($id);
        $realisateurs = $this->getPersonnes($film->getRealisateurs());
        $producteurs = $this->getPersonnes($film->getProducteurs());
        $acteurs = $this->getPersonnes($film->getActeurs());

        $categoriesFilms = $categorieRepository->findAllCategoriesFilm();
        $categoriesSeries = $categorieRepository->findAllCategoriesSerie();

        if ($this->getUser()) {
            $emprunt = new EmpruntFilm();
            $emprunt->setActif(true);
            $dateDebut= new \DateTime();

            $emprunt->setDateDebut($dateDebut);

            $dateInterval = new DateInterval('P7D');
            $dateFin = $dateDebut->add($dateInterval);

            $emprunt->setDateFin($dateFin);
            $emprunt->setFilm($film);
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
        return $this->render('film/film.html.twig', [
            'film' => $film,
            'acteurs' => $acteurs,
            'realisateurs' => $realisateurs,
            'producteurs' => $producteurs,
            'categoriesFilms' => $categoriesFilms,
            'categoriesSeries' => $categoriesSeries,
            'form' => $form->createView()
        ]);
    }

    #[Route('/films', name: 'films')]
    public function filmsIndex(FilmRepository $filmRepository, CategorieRepository $categorieRepository): Response
    {
        $films = $filmRepository->findBy(array(), array('titre' => 'ASC'));

        $categoriesFilms = $categorieRepository->findAllCategoriesFilm();
        $categoriesSeries = $categorieRepository->findAllCategoriesSerie();
        return $this->render('film/indexFilm.html.twig', [
            'films' => $films,

            'categoriesFilms' => $categoriesFilms,
            'categoriesSeries' => $categoriesSeries,
        ]);
    }

    #[Route('/films/{categorie}', name:'filmsCategorie')]
    public function filmsByCategories(string $categorie, FilmRepository $filmRepository, CategorieRepository $categorieRepository): Response
    {
        $films = $filmRepository->findByCategorie($categorie);

        $categoriesFilms = $categorieRepository->findAllCategoriesFilm();

        $categoriesSeries = $categorieRepository->findAllCategoriesSerie();
        return $this->render('film/indexFilm.html.twig', [
            'films' => $films,

            'categoriesFilms' => $categoriesFilms,
            'categoriesSeries' => $categoriesSeries,
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
