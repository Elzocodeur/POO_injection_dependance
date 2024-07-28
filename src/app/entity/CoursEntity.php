<?php

namespace App\App\Entity;

use App\Core\Entity\Entity;


class CoursEntity extends Entity
{
    private $id;
    private $libelle;
    private $nombreHeures;
    private $date_debut;
    private $date_fin;
    private $professeur_id;
    private $module_id;
    private $semestre_id;
    private $photo;
    protected $semestre_libelle;
    protected $module_libelle;
    protected $classe_id;


    public function getClasseId(){
        return $this->classe_id;
    }
    public function setClasseId($classe_id){
        $this->classe_id = $classe_id;
    }

    // Ajoutez les getters et setters pour ces nouvelles propriétés
    public function getSemestreLibelle()
    {
        return $this->semestre_libelle;
    }

    public function setSemestreLibelle($semestre_libelle)
    {
        $this->semestre_libelle = $semestre_libelle;
    }

    public function getModuleLibelle()
    {
        return $this->module_libelle;
    }

    public function setModuleLibelle($module_libelle)
    {
        $this->module_libelle = $module_libelle;
    }

    // Ajoutez les getters et setters pour toutes les propriétés


    // public function getModuleLibelle()
    // {
    //     return $this->module_libelle;
    // }
    // public function setModuleLibelle($module_libelle)
    // {
    //     $this->module_libelle = $module_libelle;
    // }

    public function getPhoto()
    {
        return $this->photo;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    public function getModuleId()
    {
        return $this->module_id;
    }
    public function setModuleId($module_id)
    {
        $this->module_id = $module_id;
    }
    public function getNombreHeures()
    {
        return $this->nombreHeures;
    }
    public function setNombreHeures($nombreHeures)
    {
        $this->nombreHeures = $nombreHeures;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
    public function getDate_debut()
    {
        return $this->date_debut;
    }
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;
    }
    public function getDate_fin()
    {
        return $this->date_fin;
    }
    public function setDate_fin($date_fin)
    {
        $this->date_fin = $date_fin;
    }
    public function getProfesseurId()
    {
        return $this->professeur_id;
    }
    public function setProfesseurId($professeur_id)
    {
        $this->professeur_id = $professeur_id;
    }
    // public function getSemestreId() { return $this->semestre_id; }
    // public function setSemestreId($semestre_id) {
    //     $this->semestre_id = $semestre_id;
    // }

    public function getSemestreId()
    {
        return $this->semestre_id;
    }
    public function setSemestreId($semestre_id)
    {
        $this->semestre_id = $semestre_id;
    }

    // Ajoutez cette méthode
    public function getSemestre()
    {
        return $this->semestre_id;
    }



}
