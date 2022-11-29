<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use Doctrine\ORM\Mapping\Id;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FilmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Film::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('annee_sortie'),
            AssociationField::new('acteurs'),
            AssociationField::new('realisateurs'),
            AssociationField::new('producteurs'),
            ImageField::new('affiche')
                ->setBasePath('images/films')
                ->setUploadDir('public/images/films')
                ->setUploadedFileNamePattern('images/films/[slug].[extension]')
                ->setSortable(false),
            TextEditorField::new('synopsis')
        ];
    }
}
