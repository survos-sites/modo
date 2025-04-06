<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ExpoRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ExpoRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['expo.read']],
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
class Expo implements TranslatableInterface
{
    use TranslatableTrait;


    public function __construct(
        #[ORM\Id]
        #[ORM\Column(length: 32)]
        #[Groups(['expo.read'])]
        private ?string $code = null
    )
    {

    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    #[Groups(['expo.read'])]
    public function getTitle(): string
    {
        return $this->translate()->getTitle();
    }
    #[Groups(['expo.read'])]
    public function getContent(): string
    {
        return $this->translate()->getContent();
    }

}
