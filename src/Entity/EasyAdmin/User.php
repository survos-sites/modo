<?php

declare(strict_types=1);

namespace App\Entity\EasyAdmin;

use Adeliom\EasyAdminUserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\EasyAdmin\UserRepository::class)]
#[ORM\Table(name: 'users')]
#[ORM\HasLifecycleCallbacks]
class User extends BaseUser
{
    #[ORM\Column(length: 48)]
    private ?string $code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cel = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isArtist = null;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getCel(): ?string
    {
        return $this->cel;
    }

    public function setCel(?string $cel): static
    {
        $this->cel = $cel;

        return $this;
    }

    public function isArtist(): ?bool
    {
        return $this->isArtist;
    }

    public function setIsArtist(?bool $isArtist): static
    {
        $this->isArtist = $isArtist;

        return $this;
    }
}
