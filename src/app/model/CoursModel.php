<?php
namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\CoursEntity;

class CoursModel extends Model {
    protected string $table = 'Cours';

    public function getEntity()
    {
        return CoursEntity::class;
    }

    public function getSemestres() {
        $sql = "SELECT id, libelle FROM Semestre";
        return $this->database->query($sql);
    }
    
    public function getModules() {
        $sql = "SELECT id, libelle FROM Module";
        return $this->database->query($sql);
    }

    // public function getCoursForUser($userId, $filter = 'all', $page = 1, $perPage = 10, $semestreId = null, $moduleId = null) {
    //     $offset = ($page - 1) * $perPage;
    //     $params = ['userId' => $userId];
    
    //     $sql = "SELECT c.*, m.libelle as moduleLibelle, s.libelle as semestreLibelle 
    //             FROM Cours c
    //             LEFT JOIN Module m ON c.module_id = m.id
    //             LEFT JOIN Semestre s ON c.semestre_id = s.id
    //             LEFT JOIN Professeur p ON c.professeur_id = p.id
    //             LEFT JOIN Utilisateur u ON p.utilisateurId = u.id
    //             WHERE u.id = :userId";
    
    //     if ($filter === 'today') {
    //         $sql .= " AND DATE(c.date_debut) = CURDATE()";
    //     } elseif ($filter === 'week') {
    //         $sql .= " AND YEARWEEK(c.date_debut, 1) = YEARWEEK(CURDATE(), 1)";
    //     }
    
    //     if ($semestreId) {
    //         $sql .= " AND c.semestre_id = :semestreId";
    //         $params['semestreId'] = $semestreId;
    //     }
    
    //     if ($moduleId) {
    //         $sql .= " AND c.module_id = :moduleId";
    //         $params['moduleId'] = $moduleId;
    //     }
    
    //     // Compter le nombre total de cours pour la pagination
    //     $countSql = "SELECT COUNT(*) as count FROM ($sql) as subquery";
    //     $totalCount = $this->database->prepare($countSql, $params);
    //     $totalCount = $totalCount[0]['count'] ?? 0;
    
    //     // Ajouter la limite pour la pagination
    //     $sql .= " LIMIT :offset, :perPage";
    //     $params['offset'] = $offset;
    //     $params['perPage'] = $perPage;
    
    //     $result = $this->database->prepare($sql, $params, $this->getEntity());
    
    //     return [
    //         'cours' => $result,
    //         'totalCount' => $totalCount
    //     ];
    // }



    // public function getCoursForUser($userId, $filter = 'all', $page = 1, $perPage = 3, $semestreId = null, $moduleId = null) {
    //     $offset = ($page - 1) * $perPage;
    //     $params = ['userId' => $userId];
    
    //     $sql = "SELECT c.*, m.libelle as module_libelle, s.libelle as semestre_libelle 
    //             FROM Cours c
    //             JOIN Professeur p ON c.professeur_id = p.id
    //             JOIN Utilisateur u ON p.utilisateurId = u.id
    //             LEFT JOIN Module m ON c.module_id = m.id
    //             LEFT JOIN Semestre s ON c.semestre_id = s.id
    //             WHERE u.id = :userId";
    
    //     if ($filter === 'today') {
    //         $sql .= " AND DATE(c.date_debut) = CURDATE()";
    //     } elseif ($filter === 'week') {
    //         $sql .= " AND YEARWEEK(c.date_debut, 1) = YEARWEEK(CURDATE(), 1)";
    //     }
    
    //     if ($semestreId) {
    //         $sql .= " AND c.semestre_id = :semestreId";
    //         $params['semestreId'] = $semestreId;
    //     }
    
    //     if ($moduleId) {
    //         $sql .= " AND c.module_id = :moduleId";
    //         $params['moduleId'] = $moduleId;
    //     }
    
    //     // Compter le nombre total de cours pour la pagination
    //     $countSql = "SELECT COUNT(*) as count FROM ($sql) as subquery";
    //     $totalCount = $this->database->prepare($countSql, $params);
    //     $totalCount = $totalCount[0]['count'] ?? 0;
    
    //     // Ajouter la limite pour la pagination
    //     $sql .= " LIMIT :offset, :perPage";
    //     $params['offset'] = $offset;
    //     $params['perPage'] = $perPage;
    
    //     $result = $this->database->prepare($sql, $params, $this->getEntity());
    
    //     return [
    //         'cours' => $result,
    //         'totalCount' => $totalCount
    //     ];
    // }
    
    // public function getAllSemestres() {
    //     return $this->database->query("SELECT * FROM Semestre ORDER BY libelle");
    // }
    
    // public function getAllModules() {
    //     return $this->database->query("SELECT * FROM Module ORDER BY libelle");
    // }




    








    public function getCoursForProfesseur($professeurId, $filter = 'all', $page = 1, $perPage = 3, $semestreId = null, $moduleId = null) {
        $offset = ($page - 1) * $perPage;
        $params = ['professeurId' => $professeurId];
    
        $sql = "SELECT c.*, m.libelle as module_libelle, s.libelle as semestre_libelle 
                FROM Cours c
                LEFT JOIN Module m ON c.module_id = m.id
                LEFT JOIN Semestre s ON c.semestre_id = s.id
                WHERE c.professeur_id = :professeurId";
    
    if ($filter === 'today') {
        $sql .= " AND DATE(c.date_debut) = CURDATE()";
    } elseif ($filter === 'week') {
        $sql .= " AND YEARWEEK(c.date_debut, 1) = YEARWEEK(CURDATE(), 1)";
    }

    if ($semestreId) {
        $sql .= " AND c.semestre_id = :semestreId";
        $params['semestreId'] = $semestreId;
    }

    if ($moduleId) {
        $sql .= " AND c.module_id = :moduleId";
        $params['moduleId'] = $moduleId;
    }
    
        // Compter le nombre total de cours pour la pagination
        $countSql = "SELECT COUNT(*) as count FROM ($sql) as subquery";
        $totalCount = $this->database->prepare($countSql, $params);
        $totalCount = $totalCount[0]['count'] ?? 0;
    
        // Ajouter la limite pour la pagination
        $sql .= " LIMIT :offset, :perPage";
        $params['offset'] = $offset;
        $params['perPage'] = $perPage;
    
        $result = $this->database->prepare($sql, $params, $this->getEntity());
    
        return [
            'cours' => $result,
            'totalCount' => $totalCount
        ];
    }
    
    public function getCoursForEtudiant($etudiantId, $filter = 'all', $page = 1, $perPage = 3, $semestreId = null, $moduleId = null) {
        $offset = ($page - 1) * $perPage;
        $params = ['etudiantId' => $etudiantId];
    
        $sql = "SELECT c.*, m.libelle as module_libelle, s.libelle as semestre_libelle 
                FROM Cours c
                JOIN Classe_cours cc ON c.id = cc.cours_id
                JOIN Classe cl ON cc.classe_id = cl.id
                LEFT JOIN Module m ON c.module_id = m.id
                LEFT JOIN Semestre s ON c.semestre_id = s.id
                WHERE cl.etudiantId = :etudiantId";
    
    if ($filter === 'today') {
        $sql .= " AND DATE(c.date_debut) = CURDATE()";
    } elseif ($filter === 'week') {
        $sql .= " AND YEARWEEK(c.date_debut, 1) = YEARWEEK(CURDATE(), 1)";
    }

    if ($semestreId) {
        $sql .= " AND c.semestre_id = :semestreId";
        $params['semestreId'] = $semestreId;
    }

    if ($moduleId) {
        $sql .= " AND c.module_id = :moduleId";
        $params['moduleId'] = $moduleId;
    }
    
        // Compter le nombre total de cours pour la pagination
        $countSql = "SELECT COUNT(*) as count FROM ($sql) as subquery";
        $totalCount = $this->database->prepare($countSql, $params);
        $totalCount = $totalCount[0]['count'] ?? 0;
    
        // Ajouter la limite pour la pagination
        $sql .= " LIMIT :offset, :perPage";
        $params['offset'] = $offset;
        $params['perPage'] = $perPage;
    
        $result = $this->database->prepare($sql, $params, $this->getEntity());
    
        return [
            'cours' => $result,
            'totalCount' => $totalCount
        ];
    }



    public function getAllSemestres() {
        return $this->database->query("SELECT * FROM Semestre ORDER BY libelle");
    }
    
    public function getAllModules() {
        return $this->database->query("SELECT * FROM Module ORDER BY libelle");
    }
 
}