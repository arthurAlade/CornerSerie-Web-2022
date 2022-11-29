<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\EmpruntFilm;
use App\Entity\EmpruntSerieSaison;
use App\Entity\Film;
use App\Entity\Personne;
use App\Entity\Saison;
use App\Entity\Serie;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         $urlEmpruntFilm = $adminUrlGenerator->setController(EmpruntFilmCrudController::class)->generateUrl();
         $urlEmpruntSerieSaison = $adminUrlGenerator->setController(EmpruntSerieSaisonCrudController::class)->generateUrl();

         return $this->redirect($urlEmpruntFilm);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CornerSerie');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToUrl('Homepage - CornerSerie', 'fas fa-portal-exit', '/');
        yield MenuItem::linkToDashboard('Administration', 'fa fa-home');
        yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');

        yield MenuItem::section('Emprunts');
        yield MenuItem::linkToCrud('Emprunts films', '', EmpruntFilm::class);
        yield MenuItem::linkToCrud('Emprunts saisons', '', EmpruntSerieSaison::class);

        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('Categorie', 'fa fa-tags', Categorie::class);
        yield MenuItem::linkToCrud('Personne', 'fa fa-user', Personne::class);
        yield MenuItem::linkToCrud('Film', 'fa fa-film', Film::class);
        yield MenuItem::linkToCrud('Serie', 'fa fa-video', Serie::class);
        yield MenuItem::linkToCrud('Saison', 'fa fa-video', Saison::class);

        yield MenuItem::section('Administration utilisateurs');
        yield MenuItem::linkToCrud('Utilisateur', 'fa fa-users', Utilisateur::class);


    }

}
