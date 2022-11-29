<?php

namespace App\DataFixtures;

use App\Entity\EmpruntFilm;
use App\Entity\EmpruntSerieSaison;
use App\Entity\Film;
use App\Entity\Saison;
use App\Entity\Utilisateur;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UtilisateurFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new Utilisateur();
        $user1->setEmail('jen.law@example.com');
        $user1->setPassword(password_hash('jennifer', PASSWORD_DEFAULT));
        $user1->setPrenom('Jennifer');
        $user1->setNom('Lawrence');

        $user2 = new Utilisateur();
        $user2->setEmail('admin@example.com');
        $user2->setPassword(password_hash('admin', PASSWORD_DEFAULT));
        $user2->setRoles(array('ROLE_SUPER_ADMIN'));
        $user2->setNom("admin");
        $user2->setPrenom("admin");

        $manager->persist($user1);
        $manager->persist($user2);

        $laCite = $manager->getRepository(Film::class)->findOneBy(array('titre' => 'La cité de la peur'));
        $laCiteEmprunt = new EmpruntFilm();
        $laCiteEmprunt->setActif(true);
        $laCiteEmprunt->setDateDebut(new  DateTime('2022-05-10'));
        $laCiteEmprunt->setDateFin(new  DateTime('2022-05-17'));
        $laCiteEmprunt->setRestituer(false);
        $laCiteEmprunt->setFilm($laCite);
        $laCiteEmprunt->setUtilisateur($user1);

        $manager->persist($laCiteEmprunt);

        $noelMonsieurJack = $manager->getRepository(Film::class)->findOneBy(array('titre'=> "L'étrange Noël de monsieur Jack"));
        $noelEmprunt = new  EmpruntFilm();
        $noelEmprunt->setActif(false);
        $noelEmprunt->setDateDebut(new DateTime("2022-04-01"));
        $noelEmprunt->setDateFin(new DateTime("2022-04-08"));
        $noelEmprunt->setRestituer(true);
        $noelEmprunt->setUtilisateur($user1);
        $noelEmprunt->setFilm($noelMonsieurJack);

        $manager->persist($noelEmprunt);

        $desperateS1 = $manager->getRepository(Saison::class)->findOneBy(array('numero'=> 1, 'nb_episodes'=> 23));

        $desperateS1Emprunt = new EmpruntSerieSaison();
        $desperateS1Emprunt->setActif(false);
        $desperateS1Emprunt->setDateDebut(new DateTime('2022-05-10'));
        $desperateS1Emprunt->setDateFin(new DateTime('2022-05-17'));
        $desperateS1Emprunt->setRestituer(false);
        $desperateS1Emprunt->setSaison($desperateS1);
        $desperateS1Emprunt->setUtilisateur($user1);

        $manager->persist($desperateS1Emprunt);

        $desperateS2 = $manager->getRepository(Saison::class)->findOneBy(array('numero'=> 2, 'nb_episodes'=> 24));

        $desperateS2Emprunt = new EmpruntSerieSaison();
        $desperateS2Emprunt->setActif(true);
        $desperateS2Emprunt->setDateDebut(new DateTime('2022-05-10'));
        $desperateS2Emprunt->setDateFin(new DateTime('2022-05-17'));
        $desperateS2Emprunt->setRestituer(false);
        $desperateS2Emprunt->setSaison($desperateS2);
        $desperateS2Emprunt->setUtilisateur($user1);

        $manager->persist($desperateS2Emprunt);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1', 'group3'];
    }
}
