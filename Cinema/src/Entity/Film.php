<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFilm = null;

    #[ORM\Column(length: 255)]
    private ?string $auteurFilm = null;

    #[ORM\Column(length: 255)]
    private ?string $acteurFilm = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateSortieFilm = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHeureDiffusion = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dureeFilm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFilm(): ?string
    {
        return $this->nomFilm;
    }

    public function setNomFilm(string $nomFilm): self
    {
        $this->nomFilm = $nomFilm;

        return $this;
    }

    public function getAuteurFilm(): ?string
    {
        return $this->auteurFilm;
    }

    public function setAuteurFilm(string $auteurFilm): self
    {
        $this->auteurFilm = $auteurFilm;

        return $this;
    }

    public function getActeurFilm(): ?string
    {
        return $this->acteurFilm;
    }

    public function setActeurFilm(string $acteurFilm): self
    {
        $this->acteurFilm = $acteurFilm;

        return $this;
    }

    public function getDateSortieFilm(): ?\DateTimeInterface
    {
        return $this->dateSortieFilm;
    }

    public function setDateSortieFilm(\DateTimeInterface $dateSortieFilm): self
    {
        $this->dateSortieFilm = $dateSortieFilm;

        return $this;
    }

    public function getDateHeureDiffusion(): ?\DateTimeInterface
    {
        return $this->dateHeureDiffusion;
    }

    public function setDateHeureDiffusion(\DateTimeInterface $dateHeureDiffusion): self
    {
        $this->dateHeureDiffusion = $dateHeureDiffusion;

        return $this;
    }

    public function getDureeFilm(): ?\DateTimeInterface
    {
        return $this->dureeFilm;
    }

    public function setDureeFilm(\DateTimeInterface $dureeFilm): self
    {
        $this->dureeFilm = $dureeFilm;

        return $this;
    }
}
