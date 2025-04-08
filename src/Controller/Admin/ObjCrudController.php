<?php

namespace App\Controller\Admin;

use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use App\Entity\Obj;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ObjCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Obj::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('code'),
            TextField::new('locale'),
            TextField::new('label'),
            TextEditorField::new('description'),
            EasyMediaField::new('file')
                ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
                ->setFormTypeOption("restrictions_uploadSize", 5.0)
                ->setFormTypeOption("hidePath", ['others', 'users/testing'])
                ->setFormTypeOption("editor", true)
                ->setFormTypeOption("upload", true)
                ->setFormTypeOption("bulk_selection", true)
                ->setFormTypeOption("move", true)
                ->setFormTypeOption("rename", true)
                ->setFormTypeOption("metas", true)
                ->setFormTypeOption("delete", true)
        ];
    }
}
