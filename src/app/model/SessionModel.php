<?php
namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\SessionCoursEntity;

class SessionModel extends Model {
    protected string $table = 'SessionCours';

    public function getEntity()
    {
        return SessionCoursEntity::class;
    }

    public function getSessionsByProfesseur($professeurId, $filter = 'all')
    {
        $sql = "SELECT s.*, c.libelle as cours_libelle
                FROM " . $this->table . " s
                JOIN Cours c ON s.cours_id = c.id
                WHERE c.professeur_id = :professeurId";

        $params = ['professeurId' => $professeurId];

        if ($filter !== 'all') {
            $sql .= " AND s.statut = :statut";
            $params['statut'] = $filter;
        }

        return $this->database->prepare($sql, $params, $this->getEntity());
    }
}