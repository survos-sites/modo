<?php

namespace App\Entity;

use App\Repository\ExpoRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Entity(repositoryClass: ExpoRepository::class)]
class Expo implements TranslatableInterface
{
    use TranslatableTrait;


    public function __construct(
        #[ORM\Id]
        #[ORM\Column(length: 32)]
        private ?string $code = null
    )
    {

    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getTitle(): string
    {
        return $this->translate()->getTitle();
    }
    public function getContent(): string
    {
        return $this->translate()->getContent();
    }

}
