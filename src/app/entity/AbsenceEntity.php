<?php

namespace App\App\Entity;

use App\Core\Entity\Entity;


class AbsenceEntity extends Entity
{
    private int $id;
    private string $etat;
    private int $etudiantId;
    public function getId(): int
    {
        return $this->id;
    }

    public function getEtat(): string
    {
        return $this->etat;
    }

    public function getEtudiantId(): int
    {
        return $this->etudiantId;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setEtat(string $etat): void
    {
        $this->etat = $etat;
    }

    public function setEtudiantId(int $etudiantId): void
    {
        $this->etudiantId = $etudiantId;
    }
}
