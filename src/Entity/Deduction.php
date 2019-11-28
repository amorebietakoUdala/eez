<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeductionRepository")
 */
class Deduction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $dependencyPercentage;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $dependencyMaximum;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $rentalPercentage;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $rentalMaximum;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $mortgagePercentage;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $mortgageMaximum;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $realPricePerHour;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $maximumPricePerHour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDependencyPercentage(): ?string
    {
        return $this->dependencyPercentage;
    }

    public function setDependencyPercentage(?string $dependencyPercentage): self
    {
        $this->dependencyPercentage = $dependencyPercentage;

        return $this;
    }

    public function getDependencyMaximum(): ?string
    {
        return $this->dependencyMaximum;
    }

    public function setDependencyMaximum(?string $dependencyMaximum): self
    {
        $this->dependencyMaximum = $dependencyMaximum;

        return $this;
    }

    public function getRentalPercentage(): ?string
    {
        return $this->rentalPercentage;
    }

    public function setRentalPercentage(?string $rentalPercentage): self
    {
        $this->rentalPercentage = $rentalPercentage;

        return $this;
    }

    public function getRentalMaximum(): ?string
    {
        return $this->rentalMaximum;
    }

    public function setRentalMaximum(?string $rentalMaximum): self
    {
        $this->rentalMaximum = $rentalMaximum;

        return $this;
    }

    public function getMortgagePercentage(): ?string
    {
        return $this->mortgagePercentage;
    }

    public function setMortgagePercentage(?string $mortgagePercentage): self
    {
        $this->mortgagePercentage = $mortgagePercentage;

        return $this;
    }

    public function getMortgageMaximum(): ?string
    {
        return $this->mortgageMaximum;
    }

    public function setMortgageMaximum(?string $mortgageMaximum): self
    {
        $this->mortgageMaximum = $mortgageMaximum;

        return $this;
    }

    public function getRealPricePerHour(): ?string
    {
        return $this->realPricePerHour;
    }

    public function setRealPricePerHour(?string $realPricePerHour): self
    {
        $this->realPricePerHour = $realPricePerHour;

        return $this;
    }

    public function getMaximumPricePerHour(): ?string
    {
        return $this->maximumPricePerHour;
    }

    public function setMaximumPricePerHour(?string $maximumPricePerHour): self
    {
        $this->maximumPricePerHour = $maximumPricePerHour;

        return $this;
    }
}
