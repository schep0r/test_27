<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeagueRepository::class)]
#[ORM\Table(name: "leagues")]
#[ORM\Index(columns:["start"])]
class League
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'integer')]
    private ?int $start;

    #[ORM\Column(name: "source_league_id", type: 'integer')]
    private ?int $sourceLeagueId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStart(): ?int
    {
        return $this->start;
    }

    public function setStart(int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getSourceLeagueId(): ?int
    {
        return $this->sourceLeagueId;
    }

    public function setSourceLeagueId(int $sourceLeagueId): self
    {
        $this->sourceLeagueId = $sourceLeagueId;

        return $this;
    }
}
