<?php
namespace App\App\Entity;

use App\Core\Entity\Entity;

class ProfesseurEntity extends Entity {
    private $id;
    private $specialite;
    private $grade;
    private $utilisateurId;

    // Getters and setters...

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // ... autres getters et setters ...
}