<?php

namespace App\Entity;

use AlexandreFernandez\JsonTranslationBundle\Model\JsonTranslation;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\LocRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Survos\CoreBundle\Entity\RouteParametersInterface;
use Survos\CoreBundle\Entity\RouteParametersTrait;
use AlexandreFernandez\JsonTranslationBundle\Doctrine\Type\JsonTranslationType;

#[ORM\Entity(repositoryClass: LocRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
class Loc implements \Stringable, RouteParametersInterface
{
    use RouteParametersTrait;
    const array UNIQUE_PARAMETERS=['locId' => 'id'];

    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: JsonTranslationType::TYPE, options: ['jsonb' => true])]
    private JsonTranslation $title;

    #[ORM\Column(type: JsonTranslationType::TYPE, options: ['jsonb' => true])]
    private JsonTranslation $content;

    #[ORM\Column(length: 2)]
    private ?string $locale = null;

    #[ORM\Column(nullable: true)]
    private ?int $orderIdx = null;

    #[ORM\Column(nullable: true)]
    private int $objCount = 0;

    /**
     * @var Collection<int, Obj>
     */
    #[ORM\OneToMany(targetEntity: Obj::class, mappedBy: 'location', orphanRemoval: true)]
    private Collection $objs;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->objs = new ArrayCollection();
        $this->title = new JsonTranslation();
        $this->content = new JsonTranslation();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->getTitle()[$this->locale] ?? null;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): static
    {
        $this->locale = $locale;

        return $this;
    }

    public function getOrderIdx(): ?int
    {
        return $this->orderIdx;
    }

    public function setOrderIdx(?int $orderIdx): static
    {
        $this->orderIdx = $orderIdx;

        return $this;
    }

    public function __toString()
    {
        return "LOC-" . $this->getId();
    }

    public function getObjCount(): ?int
    {
        return $this->objCount;
    }

    public function setObjCount(?int $objCount): static
    {
        $this->objCount = $objCount;

        return $this;
    }

    /**
     * @return Collection<int, Obj>
     */
    public function getObjs(): Collection
    {
        return $this->objs;
    }

    public function addObj(Obj $obj): static
    {
        if (!$this->objs->contains($obj)) {
            $this->objCount++;
            $this->objs->add($obj);
            $obj->setLocation($this);
        }

        return $this;
    }

    public function removeObj(Obj $obj): static
    {
        if ($this->objs->removeElement($obj)) {
            $this->objCount--;
            // set the owning side to null (unless already changed)
            if ($obj->getLocation() === $this) {
                $obj->setLocation(null);
            }
        }

        return $this;
    }

    public function getTitle(): JsonTranslation
    {
        return $this->title;
    }

    public function setTitle(JsonTranslation $title): Loc
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): JsonTranslation
    {
        return $this->content;
    }

    public function setContent(JsonTranslation $content): Loc
    {
        $this->content = $content;
        return $this;
    }


}
