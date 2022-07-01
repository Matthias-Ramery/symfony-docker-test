<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 3)]
    private $code;

    #[ORM\OneToMany(mappedBy: 'countryCode', targetEntity: ListRappel::class, orphanRemoval: true)]
    private $country;

    public function __construct()
    {
        $this->country = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, ListRappel>
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(ListRappel $country): self
    {
        if (!$this->country->contains($country)) {
            $this->country[] = $country;
            $country->setCountryCode($this);
        }

        return $this;
    }

    public function removeCountry(ListRappel $country): self
    {
        if ($this->country->removeElement($country)) {
            // set the owning side to null (unless already changed)
            if ($country->getCountryCode() === $this) {
                $country->setCountryCode(null);
            }
        }

        return $this;
    }
}
