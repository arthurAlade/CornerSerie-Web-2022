<?php

namespace App\Controller\Admin;

use App\Entity\EmpruntFilm;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class EmpruntFilmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EmpruntFilm::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('utilisateur')
                ->autocomplete(),
            AssociationField::new('film')
                ->autocomplete(),
            DateTimeField::new('dateDebut', "Date de début d'emprunt"),
            DateTimeField::new('dateFin', "Date de fin de l'emprunt")
                ->hideOnForm(),
            BooleanField::new('actif'),
            BooleanField::new('restituer')
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setDateFin(new \DateTimeImmutable());
        parent::persistEntity($entityManager, $entityInstance);
    }

}
