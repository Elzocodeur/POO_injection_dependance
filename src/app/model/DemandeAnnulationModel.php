<?php
namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\DemandeAnnulationEntity;

class DemandeAnnulationModel extends Model {
    protected string $table = 'DemandeAnnulation';

    public function getEntity()
    {
        return DemandeAnnulationEntity::class;
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO $this->table (raison, date_demande, professeur_id, session_cours_id) 
                VALUES (:raison, :date_demande, :professeur_id, :session_cours_id)";
        return $this->database->execute($sql, $data);
    }
}