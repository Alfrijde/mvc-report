<?php

namespace App\Entity;

use App\Repository\GarbageBeachKattegattOstersjonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarbageBeachKattegattOstersjonRepository::class)]
class GarbageBeachKattegattOstersjon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $urbanBeach = null;

    #[ORM\Column]
    private ?int $ruralBeach = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getUrbanBeach(): ?int
    {
        return $this->urbanBeach;
    }

    public function setUrbanBeach(int $urbanBeach): static
    {
        $this->urbanBeach = $urbanBeach;

        return $this;
    }

    public function getRuralBeach(): ?int
    {
        return $this->ruralBeach;
    }

    public function setRuralBeach(int $ruralBeach): static
    {
        $this->ruralBeach = $ruralBeach;

        return $this;
    }
}
