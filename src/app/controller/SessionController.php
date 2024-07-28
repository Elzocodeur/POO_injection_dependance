<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\Model\SessionModel;
use App\App\Model\ProfesseurModel; // Ajoutez cette ligne
use App\Core\SessionInterface;
use App\Core\Validator\ValidatorInterface;
use App\App\Model\UtilisateurModel;
use App\App\Model\DemandeAnnulationModel;
use Exception;

class SessionController extends Controller {
    private $sessionModel;
    private $professeurModel; // Ajoutez cette ligne
    protected $session;
    protected $demandeAnnulationModel;

    public function __construct(SessionModel $sessionModel, ProfesseurModel $professeurModel,DemandeAnnulationModel $demandeAnnulationModel, ValidatorInterface $validator, SessionInterface $session)
    {
        parent::__construct($validator, $session);
        $this->sessionModel = $sessionModel;
        $this->professeurModel = $professeurModel; // Ajoutez cette ligne
        $this->demandeAnnulationModel = $demandeAnnulationModel;
        $this->session = $session;
    }

    public function listeSessions() {
        $user = $this->session->get('user');
        if (!$user || $user->getRole() !== 'ROLE_PROFESSEUR') {
            $this->redirect('login');
            return;
        }

        // Obtenez l'ID du professeur à partir de l'ID de l'utilisateur
        $professeur = $this->professeurModel->findByUtilisateurId($user->getId());
        if (!$professeur) {
            $this->redirect('login');
            return;
        }

        $professeurId = $professeur->getId();
        $filter = $_GET['filter'] ?? 'all';

        $sessions = $this->sessionModel->getSessionsByProfesseur($professeurId, $filter);

        $this->renderView('sessioncours', [
            'sessions' => $sessions,
            'currentFilter' => $filter
        ]);
    }



    // public function demandeAnnulation() {
    //     $user = $this->session->get('user');
    //     if (!$user || $user->getRole() !== 'ROLE_PROFESSEUR') {
    //         return json_encode(['success' => false, 'message' => 'Accès non autorisé']);
    //     }
    
    //     $data = json_decode(file_get_contents('php://input'), true);
    //     $sessionId = $data['sessionId'] ?? null;
    //     $raison = $data['raison'] ?? null;
    
    //     if (!$sessionId || !$raison) {
    //         return json_encode(['success' => false, 'message' => 'Données manquantes']);
    //     }
    
    //     $session = $this->sessionModel->findById($sessionId);
    //     if (!$session || $session->getStatut() !== 'non-effectué') {
    //         return json_encode(['success' => false, 'message' => 'Session invalide ou déjà effectuée/annulée']);
    //     }
    
    //     $result = $this->demandeAnnulationModel->create([
    //         'raison' => $raison,
    //         'date_demande' => date('Y-m-d'),
    //         'professeur_id' => $user->getProfesseurId(),
    //         'session_cours_id' => $sessionId
    //     ]);
    
    //     if ($result) {
    //         return json_encode(['success' => true, 'message' => 'Demande d\'annulation enregistrée avec succès']);
    //     } else {
    //         return json_encode(['success' => false, 'message' => 'Erreur lors de l\'enregistrement de la demande']);
    //     }
    // }



    // App\App\Controller\SessionController.php

    public function demandeAnnulation()
    {
        header('Content-Type: application/json');
        
        // Activez l'affichage des erreurs PHP pour le débogage
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        
        try {
            $user = $this->session->get('user');
            if (!$user || $user->getRole() !== 'ROLE_PROFESSEUR') {
                throw new Exception('Accès non autorisé');
            }
            
            $data = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Données JSON invalides : ' . json_last_error_msg());
            }
            
            $sessionId = $data['sessionId'] ?? null;
            $raison = $data['raison'] ?? null;
            
            if (!$sessionId || !$raison) {
                throw new Exception('Données manquantes');
            }
            
            $session = $this->sessionModel->getSessionsByProfesseur($sessionId);
            if (!$session || $session->getStatut() !== 'non effectué') {
                throw new Exception('Session invalide ou déjà effectuée/annulée');
            }
            
            $result = $this->demandeAnnulationModel->create([
                'raison' => $raison,
                'date_demande' => date('Y-m-d'),
                'professeur_id' => $user->getProfesseurId(),
                'session_cours_id' => $sessionId
            ]);
            
            if (!$result) {
                throw new Exception('Erreur lors de l\'enregistrement de la demande');
            }
            
            echo json_encode(['success' => true, 'message' => 'Demande d\'annulation enregistrée avec succès']);
        } catch (Exception $e) {
            error_log("Erreur dans demandeAnnulation : " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}