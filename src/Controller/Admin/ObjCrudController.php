<?php

namespace App\Controller\Admin;

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
        ];
    }
}
