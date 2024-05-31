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
    /**
     * Returns the Id of the object.
     * @return int Id
     */

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * Returns the Year of the object.
     * @return int Year
     */

    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * Sets the Year of the object.
     * @return object
     */

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }
        /**
     * Returns the urbanbeach of the object. The amount of 
     * garabge collected from urban beaches on the coast of sweden.
     * @return int urbanBeach
     */

    public function getUrbanBeach(): ?int
    {
        return $this->urbanBeach;
    }
        /**
     * Sets the UrbanBeach column of the object.
     * @return object
     */

    public function setUrbanBeach(int $urbanBeach): static
    {
        $this->urbanBeach = $urbanBeach;

        return $this;
    }
    /**
     * Returns the ruralbeach of the object. The amount of 
     * garabge collected from rural beaches on the coast of sweden.
     * @return int ruralBeach
     */

    public function getRuralBeach(): ?int
    {
        return $this->ruralBeach;
    }
        /**
     * Sets the RuralBeach column of the object.
     * @return object
     */

    public function setRuralBeach(int $ruralBeach): static
    {
        $this->ruralBeach = $ruralBeach;

        return $this;
    }
}
