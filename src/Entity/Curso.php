<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomecurso = null;

    #[ORM\Column]
    private ?int $duracaocursomeses = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datapublicacao = null;

    #[ORM\OneToMany(mappedBy: 'Curso', targetEntity: Aluno::class)]
    private Collection $alunos;

    public function __construct()
    {
        $this->alunos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomecurso(): ?string
    {
        return $this->nomecurso;
    }

    public function setNomecurso(string $nomecurso): static
    {
        $this->nomecurso = $nomecurso;

        return $this;
    }

    public function getDuracaocursomeses(): ?int
    {
        return $this->duracaocursomeses;
    }

    public function setDuracaocursomeses(int $duracaocursomeses): static
    {
        $this->duracaocursomeses = $duracaocursomeses;

        return $this;
    }

    public function getDatapublicacao(): ?\DateTimeInterface
    {
        return $this->datapublicacao;
    }

    public function setDatapublicacao(\DateTimeInterface $datapublicacao): static
    {
        $this->datapublicacao = $datapublicacao;

        return $this;
    }

    /**
     * @return Collection<int, Aluno>
     */
    public function getAlunos(): Collection
    {
        return $this->alunos;
    }

    public function addAluno(Aluno $aluno): static
    {
        if (!$this->alunos->contains($aluno)) {
            $this->alunos->add($aluno);
            $aluno->setCurso($this);
        }

        return $this;
    }

    public function removeAluno(Aluno $aluno): static
    {
        if ($this->alunos->removeElement($aluno)) {
            // set the owning side to null (unless already changed)
            if ($aluno->getCurso() === $this) {
                $aluno->setCurso(null);
            }
        }

        return $this;
    }
}
