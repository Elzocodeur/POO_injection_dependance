<?php

namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\EtudiantEntity;

class EtudiantModel extends Model
{
    protected string $table = "Etudiant";


    public function getEntity()
    {
        return EtudiantEntity::class;
    }
    public function getEtudiantByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE utilisateurId = :userId";
        $result = $this->database->prepare($sql, ['userId' => $userId]);
        return $result ? $result[0] : null;
    }
}