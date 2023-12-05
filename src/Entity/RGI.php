<?php

namespace App\Entity;

use App\Repository\RGIRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RGIRepository::class)]
class RGI
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $oneMemberMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $oneMemberHeritageMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $oneMemberPensionerMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private $oneMemberPensionerHeritageMaximum;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $twoMemberMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $twoMemberHeritageMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $twoMemberPensionerMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private $twoMemberPensionerHeritageMaximum;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $threeOrMoreMemberMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $threeOrMoreMemberHeritageMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $threeOrMoreMemberPensionerMaximum = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private $threeOrMoreMemberPensionerHeritageMaximum;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $maximumPricePerHour = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private ?string $minimumPricePerMonth = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOneMemberMaximum(): ?string
    {
        return $this->oneMemberMaximum;
    }

    public function setOneMemberMaximum(string $oneMemberMaximum): self
    {
        $this->oneMemberMaximum = $oneMemberMaximum;

        return $this;
    }

    public function getOneMemberHeritageMaximum(): ?string
    {
        return $this->oneMemberHeritageMaximum;
    }

    public function setOneMemberHeritageMaximum(string $oneMemberHeritageMaximum): self
    {
        $this->oneMemberHeritageMaximum = $oneMemberHeritageMaximum;

        return $this;
    }

    public function getOneMemberPensionerMaximum(): ?string
    {
        return $this->oneMemberPensionerMaximum;
    }

    public function setOneMemberPensionerMaximum(string $oneMemberPensionerMaximum): self
    {
        $this->oneMemberPensionerMaximum = $oneMemberPensionerMaximum;

        return $this;
    }

    public function getTwoMemberMaximum(): ?string
    {
        return $this->twoMemberMaximum;
    }

    public function setTwoMemberMaximum(string $twoMemberMaximum): self
    {
        $this->twoMemberMaximum = $twoMemberMaximum;

        return $this;
    }

    public function getTwoMemberHeritageMaximum(): ?string
    {
        return $this->twoMemberHeritageMaximum;
    }

    public function setTwoMemberHeritageMaximum(string $twoMemberHeritageMaximum): self
    {
        $this->twoMemberHeritageMaximum = $twoMemberHeritageMaximum;

        return $this;
    }

    public function getTwoMemberPensionerMaximum(): ?string
    {
        return $this->twoMemberPensionerMaximum;
    }

    public function setTwoMemberPensionerMaximum(string $twoMemberPensionerMaximum): self
    {
        $this->twoMemberPensionerMaximum = $twoMemberPensionerMaximum;

        return $this;
    }

    public function getThreeOrMoreMemberMaximum(): ?string
    {
        return $this->threeOrMoreMemberMaximum;
    }

    public function setThreeOrMoreMemberMaximum(string $threeOrMoreMemberMaximum): self
    {
        $this->threeOrMoreMemberMaximum = $threeOrMoreMemberMaximum;

        return $this;
    }

    public function getThreeOrMoreMemberHeritageMaximum(): ?string
    {
        return $this->threeOrMoreMemberHeritageMaximum;
    }

    public function setThreeOrMoreMemberHeritageMaximum(string $threeOrMoreMemberHeritageMaximum): self
    {
        $this->threeOrMoreMemberHeritageMaximum = $threeOrMoreMemberHeritageMaximum;

        return $this;
    }

    public function getThreeOrMoreMemberPensionerMaximum(): ?string
    {
        return $this->threeOrMoreMemberPensionerMaximum;
    }

    public function setThreeOrMoreMemberPensionerMaximum(string $threeOrMoreMemberPensionerMaximum): self
    {
        $this->threeOrMoreMemberPensionerMaximum = $threeOrMoreMemberPensionerMaximum;

        return $this;
    }

    public function getMaximumPricePerHour(): ?string
    {
        return $this->maximumPricePerHour;
    }

    public function setMaximumPricePerHour(string $maximumPricePerHour): self
    {
        $this->maximumPricePerHour = $maximumPricePerHour;

        return $this;
    }

    public function getMinimumPricePerMonth(): ?string
    {
        return $this->minimumPricePerMonth;
    }

    public function setMinimumPricePerMonth(string $minimumPricePerMonth): self
    {
        $this->minimumPricePerMonth = $minimumPricePerMonth;

        return $this;
    }

    public function getOneMemberPensionerHeritageMaximum()
    {
        return $this->oneMemberPensionerHeritageMaximum;
    }

    public function getTwoMemberPensionerHeritageMaximum()
    {
        return $this->twoMemberPensionerHeritageMaximum;
    }

    public function getThreeOrMoreMemberPensionerHeritageMaximum()
    {
        return $this->threeOrMoreMemberPensionerHeritageMaximum;
    }

    public function setOneMemberPensionerHeritageMaximum($oneMemberPensionerHeritageMaximum)
    {
        $this->oneMemberPensionerHeritageMaximum = $oneMemberPensionerHeritageMaximum;

        return $this;
    }

    public function setTwoMemberPensionerHeritageMaximum($twoMemberPensionerHeritageMaximum)
    {
        $this->twoMemberPensionerHeritageMaximum = $twoMemberPensionerHeritageMaximum;

        return $this;
    }

    public function setThreeOrMoreMemberPensionerHeritageMaximum($threeOrMoreMemberPensionerHeritageMaximum)
    {
        $this->threeOrMoreMemberPensionerHeritageMaximum = $threeOrMoreMemberPensionerHeritageMaximum;

        return $this;
    }

    public function getCurrentBasicRent($members, $pensioner): ?float
    {
        if ($pensioner) {
            $basicRent = match ($members) {
                1 => $this->oneMemberPensionerMaximum,
                2 => $this->twoMemberPensionerMaximum,
                default => $this->threeOrMoreMemberPensionerMaximum,
            };
        } else {
            $basicRent = match ($members) {
                1 => $this->oneMemberMaximum,
                2 => $this->twoMemberMaximum,
                default => $this->threeOrMoreMemberMaximum,
            };
        }

        return $basicRent;
    }

    public function getCurrentMinimumPricePerHour()
    {
        return $this->minimumPricePerMonth / 22;
    }

    public function getCurrentMinimumPricePerMonth()
    {
        return $this->minimumPricePerMonth;
    }
}
