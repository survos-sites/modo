<?php

namespace App\Controller\Admin;

use App\Entity\Expo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Survos\TranslatableFieldBundle\EasyAdmin\Field\TranslationsField;

class ExpoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Expo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TranslationsField::new('translations')
            ->addTranslatableField(
                TextField::new('title')->setRequired(true)->setColumns(6)
            )
            ->addTranslatableField(
                TextareaField::new('content')->setRequired(true)->setColumns(6),
//                TextEditorField::new('body')->setRequired(true)->setColumns(6),
                CodeEditorField::new('body')->setLanguage('markdown'),
//        CodeEditorField::new('body')->setLanguage('markdown')->setRequired(true)->setNumOfRows(6)->setColumns(12)
            )
        ;

        return [
            IdField::new('id'),
            TextField::new('code'),
        ];
    }
}
