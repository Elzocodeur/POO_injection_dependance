<?php
namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\ProfesseurEntity;

class ProfesseurModel extends Model {
    protected string $table = 'Professeur';

    public function getEntity()
    {
        return ProfesseurEntity::class;
    }

    public function findByUtilisateurId($utilisateurId)
    {
        $sql = "SELECT * FROM $this->table WHERE utilisateurId = :utilisateurId";
        return $this->database->prepare($sql, ['utilisateurId' => $utilisateurId], $this->getEntity(), true);
    }

    public function getProfesseurByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE utilisateurId = :userId";
        $result = $this->database->prepare($sql, ['userId' => $userId]);
        return $result ? $result[0] : null;
    }
}