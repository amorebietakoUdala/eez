<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\IsValidDNI;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpedientRepository")
 */
class Expedient
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
     * )
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
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $pensioner;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $heritage;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $equityIncrease;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $rentExpense;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $mortgageExpense;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $dependencyBonus;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $rentBonus;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $mortgageBonus;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $rawIncome;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $netIncome;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $numberOfHours;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $monthlyContribution;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $pricePerHour;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createDate;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastModificationDate;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $modifiedBy;

    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="expedient", cascade={"persist", "remove"})
     */
    private $members;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCapitalIncome(): ?string
    {
        return $this->capitalIncome;
    }

    public function setCapitalIncome(string $capitalIncome): self
    {
        $this->capitalIncome = $capitalIncome;

        return $this;
    }

    public function getPensioner(): ?bool
    {
        return $this->pensioner;
    }

    public function setPensioner(bool $pensioner): self
    {
        $this->pensioner = $pensioner;

        return $this;
    }

    public function getHeritage(): ?string
    {
        return $this->heritage;
    }

    public function setHeritage(string $heritage): self
    {
        $this->heritage = $heritage;

        return $this;
    }

    public function getRentExpense(): ?string
    {
        return $this->rentExpense;
    }

    public function setRentExpense(string $rentExpense): self
    {
        $this->rentExpense = $rentExpense;

        return $this;
    }

    public function getMortgageExpense(): ?string
    {
        return $this->mortgageExpense;
    }

    public function setMortgageExpense(string $mortgageExpense): self
    {
        $this->mortgageExpense = $mortgageExpense;

        return $this;
    }

    public function getCreateDate(): ?DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(DateTimeInterface $createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function setMembers($members): self
    {
        $this->members = $members;

        return $this;
    }

    public function getDependencyBonus()
    {
        return $this->dependencyBonus;
    }

    public function getRentBonus()
    {
        return $this->rentBonus;
    }

    public function getMortgageBonus()
    {
        return $this->mortgageBonus;
    }

    public function getRawIncome()
    {
        return $this->rawIncome;
    }

    public function getNetIncome()
    {
        return $this->netIncome;
    }

    public function getNumberOfHours()
    {
        return $this->numberOfHours;
    }

    public function getMonthlyContribution()
    {
        return $this->monthlyContribution;
    }

    public function getPricePerHour()
    {
        return $this->pricePerHour;
    }

    public function setDependencyBonus($dependencyBonus)
    {
        $this->dependencyBonus = $dependencyBonus;

        return $this;
    }

    public function setRentBonus($rentBonus)
    {
        $this->rentBonus = $rentBonus;

        return $this;
    }

    public function setMortgageBonus($mortgageBonus)
    {
        $this->mortgageBonus = $mortgageBonus;

        return $this;
    }

    public function setRawIncome($rawIncome)
    {
        $this->rawIncome = $rawIncome;

        return $this;
    }

    public function setNetIncome($netIncome)
    {
        $this->netIncome = $netIncome;

        return $this;
    }

    public function setNumberOfHours($numberOfHours)
    {
        $this->numberOfHours = $numberOfHours;

        return $this;
    }

    public function setMonthlyContribution($monthlyContribution)
    {
        $this->monthlyContribution = $monthlyContribution;

        return $this;
    }

    public function setPricePerHour($pricePerHour)
    {
        $this->pricePerHour = $pricePerHour;

        return $this;
    }

    public function getEquityIncrease()
    {
        return $this->equityIncrease;
    }

    public function setEquityIncrease($equityIncrease)
    {
        $this->equityIncrease = $equityIncrease;

        return $this;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname1()
    {
        return $this->surname1;
    }

    public function getSurname2()
    {
        return $this->surname2;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setSurname1($surname1)
    {
        $this->surname1 = $surname1;

        return $this;
    }

    public function setSurname2($surname2)
    {
        $this->surname2 = $surname2;

        return $this;
    }

    public function addMember(Member $member)
    {
        $member->setExpedient($this);
        $this->members->add($member);
    }

    public function removeMember(Member $member)
    {
        $this->members->removeElement($member);
    }

    public function getLastModificationDate()
    {
        return $this->lastModificationDate;
    }

    public function setLastModificationDate($lastModificationDate)
    {
        $this->lastModificationDate = $lastModificationDate;

        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;

        return $this;
    }
}
