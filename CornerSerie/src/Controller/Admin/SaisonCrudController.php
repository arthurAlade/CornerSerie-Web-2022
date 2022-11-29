<?php

namespace App\Controller\Admin;

use App\Entity\Saison;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class SaisonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Saison::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('serie')->autocomplete(),
            NumberField::new('numero', 'Numéro de la saison'),
            NumberField::new('nb_episodes', "Nombre d'épisodes"),
            ImageField::new('affiche')
                ->setBasePath('images/series')
                ->setUploadedFileNamePattern('images/series/[slug].[extension]')
                ->setUploadDir('public/images/series')
                ->setSortable(false),
            TextEditorField::new('synopsis')
        ];
    }
}
