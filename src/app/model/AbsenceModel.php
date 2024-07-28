<?php
namespace App\App\Model;
use App\Core\Model\Model;
use App\App\Entity\AbsenceEntity;


class AbsenceModel extends Model
{
    protected string $table = 'Absence';

    public function getEntity()
    {
        return AbsenceEntity::class;
    }

    public function getAbsencesByStudentId(int $studentId): array
    {
        $sql = "SELECT a.*, sc.date, sc.heure_debut, sc.heure_fin, c.libelle AS cours_libelle, m.libelle AS module_libelle, cl.filiere AS classe_filiere, cl.niveau AS classe_niveau
                FROM {$this->table} a
                JOIN SessionCours sc ON a.id = sc.absence_id
                JOIN Cours c ON sc.cours_id = c.id
                JOIN Module m ON c.module_id = m.id
                JOIN Classe_cours cc ON c.id = cc.cours_id
                JOIN Classe cl ON cc.classe_id = cl.id
                WHERE a.etudiantId = :etudiantId
                ORDER BY sc.date DESC, sc.heure_debut DESC";
    
        return $this->database->prepare($sql, ['etudiantId' => $studentId]);
    }
}
