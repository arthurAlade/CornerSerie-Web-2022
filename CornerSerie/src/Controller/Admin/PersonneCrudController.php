<?php

namespace App\Controller\Admin;

use App\Entity\Personne;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PersonneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Personne::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('prenom'),
            TextField::new('nom'),
            ImageField::new('photo')
                ->setBasePath('images/personnes')
                ->setUploadDir('public/images/personnes')
                ->setSortable(false),
        ];
    }
}
