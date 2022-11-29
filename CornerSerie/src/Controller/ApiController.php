<?php

namespace App\Controller;

use App\Entity\EmpruntFilm;
use App\Repository\EmpruntFilmRepository;
use App\Repository\EmpruntSerieSaisonRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/v1/utilisateurs', name: 'api_utilisateurs', methods: ['GET'])]
    public function getAllUtilisateurs(UtilisateurRepository $utilisateurRepository)
    {
        $utilisateurs = $utilisateurRepository->findAll();

        return $this->json([
            "utilisateurs" => $utilisateurs
        ]);
    }

    #[Route('/api/v1/utilisateur/emprunts/films/{id}', name: 'api_utilisateur_emprunts_films', requirements: ['id' => '[1-9]\d*'], methods: 'GET')]
    public function getEmpruntsFilmsByUtilisateur(int $id, EmpruntFilmRepository $empruntFilmRepository, EmpruntSerieSaisonRepository $empruntSerieSaisonRepository)
    {
        $pastFilm = $empruntFilmRepository->findAllPastFromUser($id);
        $currentFilm = $empruntFilmRepository->findAllCurrentFromUser($id);
        //dd($pastFilm);
        return $this->json([
                "films" => [
                    "past" => $pastFilm,
                    "current" => $currentFilm
                ],
        ],Response::HTTP_OK, [], ['groups'=>['emprunt_film', 'film']]);
    }
    #[Route('/api/v1/utilisateur/emprunts/series/{id}', name: 'api_utilisateur_emprunts_series', requirements: ['id' => '[1-9]\d*'], methods: 'GET')]
    public function getEmpruntsSerieByUtilisateur(int $id, EmpruntSerieSaisonRepository $empruntSerieSaisonRepository)
    {
        $pastSerie = $empruntSerieSaisonRepository->findAllPastFomUser($id);
        $currentSerie = $empruntSerieSaisonRepository->findAllCurrentFomUser($id);
        //dd($pastSerie);
        return $this->json([
            "series" => [
                "past" => $pastSerie,
                "current" => $currentSerie
            ]
        ],Response::HTTP_OK, [], ['groups'=>['emprunt_serie','saison', 'serie']]);
    }

    #[Route("/api/v1/utilisateur/emprunts/rendre/film/{id}/{id_emprunt}", name: 'api_utilisateur_emprunts_rendre_film', requirements: ['id' =>'[1-9]\d*', 'id_emprunt'=> '[1-9]\d*'], methods: 'POST')]
    public function postRendreFilm(int $id, int $id_emprunt, EmpruntFilmRepository $empruntFilmRepository, ManagerRegistry $doctrine)
    {
        $empruntFilmRepository->updateEmpruntFilmActif($id, $id_emprunt, false, $doctrine, $empruntFilmRepository);
        return $this->json(['emprunt'=> 'ok'], Response::HTTP_OK );
    }

    #[Route("/api/v1/utilisateur/emprunts/rendre/serie/{id}/{id_emprunt}", name: 'api_utilisateur_emprunts_rendre_serie', requirements: ['id' =>'[1-9]\d*', 'id_emprunt'=> '[1-9]\d*'], methods: 'POST')]
    public function postRendreSerie(int $id, int $id_emprunt, EmpruntSerieSaisonRepository $empruntSerieSaisonRepository, ManagerRegistry $doctrine)
    {
        $empruntSerieSaisonRepository->updateEmpruntFilmActif($id, $id_emprunt, false, $doctrine, $empruntSerieSaisonRepository);
        return $this->json(['emprunt'=> 'ok'], Response::HTTP_OK );
    }


}
