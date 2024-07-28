<?php
namespace App\App\Entity;

use App\Core\Entity\Entity;

class EtudiantEntity extends Entity {
    private $id;
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