<?php

namespace App\Entity;

use App\Repository\ListRappelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListRappelRepository::class)]
class ListRappel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 15)]
    private $phoneNumberNational;

    #[ORM\Column(type: 'string', length: 15)]
    private $phoneNumberInternational;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'country')]
    #[ORM\JoinColumn(nullable: false)]
    private $countryCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumberNational(): ?string
    {
        return $this->phoneNumberNational;
    }

    public function setPhoneNumberNational(string $phoneNumberNational): self
    {
        $this->phoneNumberNational = $phoneNumberNational;

        return $this;
    }

    public function getPhoneNumberInternational(): ?string
    {
        return $this->phoneNumberInternational;
    }

    public function setPhoneNumberInternational(string $phoneNumberInternational): self
    {
        $this->phoneNumberInternational = $phoneNumberInternational;

        return $this;
    }

    public function getCountryCode(): ?Country
    {
        return $this->countryCode;
    }

    public function setCountryCode(?Country $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }
}
