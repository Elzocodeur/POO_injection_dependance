<?php
namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\UtilisateurEntity;

class UtilisateurModel extends Model {
    protected string $table = 'Utilisateur';

    public function getEntity() {
        return UtilisateurEntity::class;
    }

    public function findByLogin($login) {
        $sql = "SELECT * FROM $this->table WHERE login = :login";
        return $this->database->prepare($sql, ['login' => $login], $this->getEntity(), true);
    }
}