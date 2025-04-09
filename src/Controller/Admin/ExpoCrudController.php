<?php

namespace App\Controller\Admin;

use App\Entity\Expo;
use Doctrine\DBAL\Types\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Survos\TranslatableFieldBundle\EasyAdmin\Field\TranslationsField;
use Survos\TranslatableFieldBundle\EasyAdmin\Field\TranslationsSimpleField;
use function Symfony\Component\Translation\t;

class ExpoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Expo::class;
    }

    public function configureFields(string $pageName): iterable
    {
//        yield IdField::new('id');
        yield TextField::new('code', t('code'));
//        yield TranslationsSimpleField::new('translations', '@translations', [
//            'title' => [
//                'field_type' => TextType::class,
//                'required'   => true
//                ]
//        ]);
        // these are the _translated_ values, virtual field, so hide on the form
        yield TextField::new('title')->hideOnForm();
        yield TextField::new('content')->hideOnForm();

        yield TranslationsField::new('translations')
            ->addTranslatableField(
                TextField::new('title') /// ->setRequired(true)->setColumns(6)
            )
            ->addTranslatableField(
                TextareaField::new('content')
                    ->setNumOfRows(9)
            /// ->setRequired(true)->setColumns(6)
//                 CodeEditorField::new('content')->setLanguage('markdown')
            )
//            ->addTranslatableField(
//                TextareaField::new('content')->setRequired(true)->setColumns(6),
//                TextEditorField::new('body')->setRequired(true)->setColumns(6),
//                CodeEditorField::new('body')->setLanguage('markdown'),
//        CodeEditorField::new('body')->setLanguage('markdown')->setRequired(true)->setNumOfRows(6)->setColumns(12)
//            )
        ;

        return [
        ];
    }
}
