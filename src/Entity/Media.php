<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $expoCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpoCode(): ?string
    {
        return $this->expoCode;
    }

    public function setExpoCode(?string $expoCode): static
    {
        $this->expoCode = $expoCode;

        return $this;
    }
}
