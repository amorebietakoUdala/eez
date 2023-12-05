<?php

namespace App\Entity;

use App\Repository\DeductionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DeductionRepository::class)]
class Deduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    #[Assert\PositiveOrZero]
    #[Assert\NotBlank]
    private $dependencyMinimum;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2, nullable: true)]
    #[Assert\PositiveOrZero]
    #[Assert\NotBlank]
    private ?string $dependencyMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2, nullable: true)]
    #[Assert\PositiveOrZero]
    #[Assert\NotBlank]
    private ?string $housingPercentage = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2, nullable: true)]
    #[Assert\PositiveOrZero]
    #[Assert\NotBlank]
    private ?string $housingMaximum = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDependencyMinimum(): ?string
    {
        return $this->dependencyMinimum;
    }

    public function setDependencyMinimum($dependencyMinimum): self
    {
        $this->dependencyMinimum = $dependencyMinimum;

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

    public function getHousingPercentage(): ?string
    {
        return $this->housingPercentage;
    }

    public function setHousingPercentage(?string $housingPercentage): self
    {
        $this->housingPercentage = $housingPercentage;

        return $this;
    }

    public function getHousingMaximum(): ?string
    {
        return $this->housingMaximum;
    }

    public function setHousingMaximum(?string $housingMaximum): self
    {
        $this->housingMaximum = $housingMaximum;

        return $this;
    }

    public function getCurrentDependencyBonus($dependencyGrade, $discapacity65, $members)
    {
        $numberOfDependants = 0;
        $dependencyBonus = 0;
        if (3 === $dependencyGrade || $discapacity65) {
            $dependencyBonus = $this->dependencyMinimum;
            $numberOfDependants += 1;
        }
        foreach ($members as $member) {
            if ($member->isDependant()) {
                $numberOfDependants += 1;
            }
        }
        if ($numberOfDependants >= 2) {
            $dependencyBonus = $this->dependencyMaximum;
        }

        return $dependencyBonus;
    }

    public function getCurrentHousingBonus($housingExpediture)
    {
        if (null === $housingExpediture || 0 === $housingExpediture) {
            return 0;
        }
        $housingExpeditureBonus = $housingExpediture * 12 * $this->housingPercentage / 100;
        if ($housingExpeditureBonus > $this->housingMaximum) {
            return $this->housingMaximum;
        } else {
            return $housingExpeditureBonus;
        }
    }
}
