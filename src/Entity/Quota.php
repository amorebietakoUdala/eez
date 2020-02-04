<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\IsValidDNI;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuotaRepository")
 */
class Quota
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     * @Assert\NotBlank(groups={"saveQuota"})
     * @IsValidDNI(groups={"saveQuota"})
     * )
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(groups={"saveQuota"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(groups={"saveQuota"})
     */
    private $surname1;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(groups={"saveQuota"})
     */
    private $surname2;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\PositiveOrZero(groups={"saveQuota"})
     */
    private $incomeAndAid;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $pensioner;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     * @Assert\NotBlank(groups={"saveQuota"})
     */
    private $sex;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $discapacity65;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\PositiveOrZero(groups={"saveQuota"})
     */
    private $heritage;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\PositiveOrZero(groups={"saveQuota"})
     */
    private $totalHouseholdIncome;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, options={"default" : 0}, nullable=true)
     */
    private $housingExpediture;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    private $equityIncrease;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dependencyGrade;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\PositiveOrZero(groups={"saveQuota"})
     */
    private $housingBonus;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\PositiveOrZero(groups={"saveQuota"})
     */
    private $dependencyBonus;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\PositiveOrZero(groups={"saveQuota","calculateQuota"})
     * @Assert\NotBlank(groups={"calculateQuota"})
     */
    private $numberOfHours;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    private $monthlyContribution;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\PositiveOrZero(groups={"saveQuota"})
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
     * @ORM\OneToMany(targetEntity="Member", mappedBy="quota", orphanRemoval=true, cascade={"persist", "remove"})
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

    public function getIncomeAndAid()
    {
        return $this->incomeAndAid;
    }

    public function getProfessionalIncome()
    {
        return $this->professionalIncome;
    }

    public function getCapitalIncome()
    {
        return $this->capitalIncome;
    }

    public function getPensioner()
    {
        return $this->pensioner;
    }

    public function getDiscapacity65()
    {
        return $this->discapacity65;
    }

    public function getHeritage()
    {
        return $this->heritage;
    }

    public function getEquityIncrease()
    {
        return $this->equityIncrease;
    }

    public function getHousingExpediture()
    {
        return $this->housingExpediture;
    }

    public function getDependencyGrade()
    {
        return $this->dependencyGrade;
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

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getLastModificationDate()
    {
        return $this->lastModificationDate;
    }

    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    public function getMembers()
    {
        return $this->members;
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

    public function setIncomeAndAid($incomeAndAid)
    {
        $this->incomeAndAid = $incomeAndAid;

        return $this;
    }

    public function setProfessionalIncome($professionalIncome)
    {
        $this->professionalIncome = $professionalIncome;

        return $this;
    }

    public function setCapitalIncome($capitalIncome)
    {
        $this->capitalIncome = $capitalIncome;

        return $this;
    }

    public function setPensioner($pensioner)
    {
        $this->pensioner = $pensioner;

        return $this;
    }

    public function setDiscapacity65($discapacity65)
    {
        $this->discapacity65 = $discapacity65;

        return $this;
    }

    public function setHeritage($heritage)
    {
        $this->heritage = $heritage;

        return $this;
    }

    public function setEquityIncrease($equityIncrease)
    {
        $this->equityIncrease = $equityIncrease;

        return $this;
    }

    public function setHousingExpediture($housingExpediture)
    {
        $this->housingExpediture = $housingExpediture;

        return $this;
    }

    public function setDependencyGrade($dependencyGrade)
    {
        $this->dependencyGrade = $dependencyGrade;

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

    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function setLastModificationDate($lastModificationDate)
    {
        $this->lastModificationDate = $lastModificationDate;

        return $this;
    }

    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;

        return $this;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    public function getHousingBonus()
    {
        return $this->housingBonus;
    }

    public function setHousingBonus($housingBonus)
    {
        $this->housingBonus = $housingBonus;

        return $this;
    }

    public function getDependencyBonus()
    {
        return $this->dependencyBonus;
    }

    public function setDependencyBonus($dependencyBonus)
    {
        $this->dependencyBonus = $dependencyBonus;

        return $this;
    }

    public function addMember(Member $member)
    {
        if ($this->members->contains($member)) {
            return;
        }
        $this->members[] = $member;
        $member->setQuota($this);
    }

    public function removeMember(Member $member)
    {
        if (!$this->members->contains($member)) {
            return;
        }
        $this->members->removeElement($member);
    }

    public function getMemberCount(): ?int
    {
        return count($this->members) + 1;
    }

    public function getTotalHeritage(): ?float
    {
        $heritage = $this->heritage;
        /* @var $member Member */
        foreach ($this->members as $member) {
            $heritage += $member->getHeritage();
        }

        return $heritage;
    }

    public function calculateEquityIncrease(RGI $rgi)
    {
        $members = $this->getMemberCount();
        $pensioner = $this->pensioner;
        if ($pensioner) {
            switch ($members) {
                case 1:
                    $heritageMaximum = $rgi->getOneMemberPensionerHeritageMaximum();
                    break;
                case 2:
                    $heritageMaximum = $rgi->getTwoMemberPensionerHeritageMaximum();
                    break;
                default:
                    $heritageMaximum = $rgi->getThreeOrMoreMemberPensionerHeritageMaximum();
                    break;
            }
        } else {
            switch ($members) {
                case 1:
                    $heritageMaximum = $rgi->getOneMemberHeritageMaximum();
                    break;
                case 2:
                    $heritageMaximum = $rgi->getTwoMemberHeritageMaximum();
                    break;
                default:
                    $heritageMaximum = $rgi->getThreeOrMoreMemberHeritageMaximum();
                    break;
            }
        }

        if ($this->getTotalHeritage() - $heritageMaximum < 0) {
            return 0;
        } else {
            return $this->getTotalHeritage() - $heritageMaximum;
        }
    }

    public function getTotalHouseholdIncome(): ?float
    {
        $income = $this->incomeAndAid;
        /* @var $member Member */
        foreach ($this->members as $member) {
            $income += $member->getIncomeAndAid();
        }

        return $income;
    }

    public function setTotalHouseholdIncome($totalHouseholdIncome): self
    {
        $this->totalHouseholdIncome = $totalHouseholdIncome;

        return $this;
    }

    public function calculateTotalHouseholdIncome(): ?float
    {
        return $this->getTotalHouseholdIncome();
    }

    public function setBonuses(Deduction $deduction, $members)
    {
        $this->setDependencyBonus($deduction->getCurrentDependencyBonus($this->dependencyGrade, $this->discapacity65, $members));
        $this->setHousingBonus($deduction->getCurrentHousingBonus($this->housingExpediture));
    }

    public function calculateR(Deduction $deduction, RGI $rgi)
    {
        $monthlyIncome =
            ($this->calculateTotalHouseholdIncome()
            + $this->equityIncrease
            - $deduction->getCurrentDependencyBonus($this->dependencyGrade, $this->discapacity65, $this->members)
            - $deduction->getCurrentHousingBonus($this->housingExpediture)) / 12;

        $rest = $monthlyIncome - $rgi->getCurrentBasicRent($this->getMemberCount(), $this->pensioner);
        $r = $rest * 15 / 100;

        return $r;
    }

    public function calculateMonthlyContribution(Deduction $deduction, RGI $rgi)
    {
        $monthlyContribution = $this->calculateR($deduction, $rgi) * (1 + ($this->numberOfHours / 100));
        if ($monthlyContribution < $rgi->getCurrentMinimumPricePerMonth()) {
            return $rgi->getCurrentMinimumPricePerMonth();
        } else {
            return $monthlyContribution;
        }

        return $monthlyContribution;
    }

    public function calculatePricePerHour(Deduction $deduction, RGI $rgi)
    {
        $pricePerHour = $this->calculateMonthlyContribution($deduction, $rgi) / $this->numberOfHours;

        if ($pricePerHour >= $rgi->getMaximumPricePerHour()) {
            return $rgi->getMaximumPricePerHour();
        }

        return $pricePerHour;
    }
}
