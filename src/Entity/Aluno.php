<?php

namespace App\Entity;

use App\Repository\AlunoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlunoRepository::class)]
class Aluno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nome = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dtnascimento = null;

    #[ORM\Column(length: 10)]
    private ?string $telefone = null;

    #[ORM\Column(length: 50)]
    private ?string $endereco = null;

    #[ORM\ManyToOne(inversedBy: 'alunos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Curso $Curso = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDtnascimento(): ?\DateTimeInterface
    {
        return $this->dtnascimento;
    }

    public function setDtnascimento(\DateTimeInterface $dtnascimento): static
    {
        $this->dtnascimento = $dtnascimento;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): static
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): static
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getCurso(): ?Curso
    {
        return $this->Curso;
    }

    public function setCurso(?Curso $Curso): static
    {
        $this->Curso = $Curso;

        return $this;
    }
}
