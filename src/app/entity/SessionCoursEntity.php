<?php
namespace App\App\Entity;
use App\Core\Entity\Entity;


class SessionCoursEntity  extends Entity{
    private $id;
    private $date;
    private $heure_debut;
    private $heure_fin;
    private $statut;
    private $cours_id;
    private $salle_id;
    private $cours_libelle; 
    protected $absence_id; 

    // Getters and setters for all properties
    // ...

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getHeureDebut() {
        return $this->heure_debut;
    }

    public function getHeureFin() {
        return $this->heure_fin;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getCoursId() {
        return $this->cours_id;
    }

    public function getSalleId() {
        return $this->salle_id;
    }


    public function getCoursLibelle() {
        return $this->cours_libelle;
    }

    public function setCoursLibelle($cours_libelle) {
        $this->cours_libelle = $cours_libelle;
    }

    public function getAbsenceId()
    {
        return $this->absence_id;
    }

    public function setAbsenceId($absence_id)
    {
        $this->absence_id = $absence_id;
    }
}