<?php

namespace App\App\Entity;

use App\Core\Entity\Entity;

class DemandeAnnulationEntity extends Entity {
    private $id;
    private $raison;
    private $date_demande;
    private $professeur_id;
    private $session_cours_id;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getRaison() {
        return $this->raison;
    }

    public function getDateDemande() {
        return $this->date_demande;
    }

    public function getProfesseurId() {
        return $this->professeur_id;
    }

    public function getSessionCoursId() {
        return $this->session_cours_id;
    }

    // Setters
    public function setRaison($raison) {
        $this->raison = $raison;
    }

    public function setDateDemande($date_demande) {
        $this->date_demande = $date_demande;
    }

    public function setProfesseurId($professeur_id) {
        $this->professeur_id = $professeur_id;
    }

    public function setSessionCoursId($session_cours_id) {
        $this->session_cours_id = $session_cours_id;
    }
}