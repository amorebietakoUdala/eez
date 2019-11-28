<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\IsValidDNI;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     * @Assert\NotBlank
     * @IsValidDNI()
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $surname1;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $surname2;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $incomeAndAid;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $professionalIncome;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $capitalIncome;

    /**
     * @ORM\Column(type="boolean")
     */
    private $dependency;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\PositiveOrZero
     */
    private $dependencyAmount;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $numberOfHours;

    /**
     * @ORM\ManyToOne(targetEntity="Expedient", inversedBy="members")
     * @ORM\JoinColumn(name="expedient_id", referencedColumnName="id")
     */
    private $expedient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname1(): ?string
    {
        return $this->surname1;
    }

    public function setSurname1(string $surname1): self
    {
        $this->surname1 = $surname1;

        return $this;
    }

    public function getSurname2(): ?string
    {
        return $this->surname2;
    }

    public function setSurname2(?string $surname2): self
    {
        $this->surname2 = $surname2;

        return $this;
    }

    public function getIncomeAndAid(): ?string
    {
        return $this->incomeAndAid;
    }

    public function setIncomeAndAid(string $incomeAndAid): self
    {
        $this->incomeAndAid = $incomeAndAid;

        return $this;
    }

    public function getProfessionalIncome(): ?string
    {
        return $this->professionalIncome;
    }

    public function setProfessionalIncome(string $professionalIncome): self
    {
        $this->professionalIncome = $professionalIncome;

        return $this;
    }

    public function getDependency(): ?bool
    {
        return $this->dependency;
    }

    public function setDependency(bool $dependency): self
    {
        $this->dependency = $dependency;

        return $this;
    }

    public function getDependencyAmount(): ?string
    {
        return $this->dependencyAmount;
    }

    public function setDependencyAmount(string $dependencyAmount): self
    {
        $this->dependencyAmount = $dependencyAmount;

        return $this;
    }

    public function getNumberOfHours(): ?string
    {
        return $this->numberOfHours;
    }

    public function setNumberOfHours(string $numberOfHours): self
    {
        $this->numberOfHours = $numberOfHours;

        return $this;
    }

    public function getExpedient(): Expedient
    {
        return $this->expedient;
    }

    public function setExpedient($expedient): self
    {
        $this->expedient = $expedient;

        return $this;
    }

    public function getCapitalIncome(): ?string
    {
        return $this->capitalIncome;
    }

    public function setCapitalIncome($capitalIncome): self
    {
        $this->capitalIncome = $capitalIncome;

        return $this;
    }
}
