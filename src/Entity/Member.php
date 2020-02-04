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
    private $heritage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dependencyGrade;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $discapacity65;

    /**
     * @ORM\ManyToOne(targetEntity="Quota", inversedBy="members")
     * @ORM\JoinColumn(name="quota_id", referencedColumnName="id")
     */
    private $quota;

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

    public function getQuota(): Quota
    {
        return $this->quota;
    }

    public function setQuota(Quota $quota)
    {
        $this->quota = $quota;

        return $this;
    }

    public function getDiscapacity65()
    {
        return $this->discapacity65;
    }

    public function setDiscapacity65($discapacity65)
    {
        $this->discapacity65 = $discapacity65;

        return $this;
    }

    public function getDependencyGrade()
    {
        return $this->dependencyGrade;
    }

    public function setDependencyGrade($dependencyGrade)
    {
        $this->dependencyGrade = $dependencyGrade;

        return $this;
    }

    public function getHeritage()
    {
        return $this->heritage;
    }

    public function setHeritage($heritage)
    {
        $this->heritage = $heritage;

        return $this;
    }

    public function isDependant()
    {
        if (3 === $this->dependencyGrade || $this->discapacity65) {
            return true;
        }

        return false;
    }
}
