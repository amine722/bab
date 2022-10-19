<?php

namespace App\Entity;

use App\Repository\etudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: etudiantRepository::class)]
class etudiant
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $nsc = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'etudiant')]
    private ?Classroom $classroom = null;

    public function getnsc(): ?int
    {
        return $this->nsc;
    }
    public function setnsc(): ?int
    {
        return $this->nsc=$nsc;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }
}
