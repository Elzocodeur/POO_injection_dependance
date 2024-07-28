<?php 


namespace App\App\Entity;

use App\Core\Entity\Entity;

class UtilisateurEntity extends Entity {
    private $id;
    private $nom;
    private $prenom;
    private $login;
    private $password;
    private $rolesId;
    

    // Getters and setters for each property

    
    // ... autres propriétés et méthodes
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }


    public function getRolesId() {
        return $this->rolesId;
    }

    public function setRolesId($rolesId) {
        $this->rolesId = $rolesId;
    }

    public function getRole() {
        // Vous devrez implémenter la logique pour obtenir le rôle basé sur rolesId
        // Par exemple :
        return $this->rolesId == 2 ? 'ROLE_PROFESSEUR' : 'ROLE_ETUDIANT';
    }
    
}
