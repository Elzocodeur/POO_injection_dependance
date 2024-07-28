<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\Model\CoursModel;
use App\Core\SessionInterface;
use App\Core\Validator\ValidatorInterface;
use App\App\Model\ProfesseurModel;
use App\App\Model\EtudiantModel;

class CoursController extends Controller {
    private $coursModel;
    private $professeurModel;
    private $etudiantModel;
    protected $session;


    public function __construct(CoursModel $coursModel, ProfesseurModel $professeurModel, EtudiantModel $etudiantModel,  ValidatorInterface $validator, SessionInterface $session)
    {
        parent::__construct($validator, $session);
        $this->coursModel = $coursModel;
        $this->professeurModel = $professeurModel;
        $this->etudiantModel = $etudiantModel;
        $this->session = $session;
    }



    // public function listeCours() {
    //     $user = $this->session->get('user');
    //     if (!$user) {
    //         $this->redirect('/login');
    //         return;
    //     }
    
    //     $userId = $user->getId();
    //     $filter = $_GET['filter'] ?? 'all';
    //     $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    //     $perPage = 3;
    //     $semestreId = $_GET['semestre'] ?? null;
    //     $moduleId = $_GET['module'] ?? null;
    
    //     $result = $this->coursModel->getCoursForUser($userId, $filter, $page, $perPage, $semestreId, $moduleId);
    //     $cours = $result['cours'];
    //     $totalCount = $result['totalCount'];
    //     $totalPages = ceil($totalCount / $perPage);
    
    //     $semestres = $this->coursModel->getSemestres();
    //     $modules = $this->coursModel->getModules();
    
    //     $this->renderView('listecours', [
    //         'cours' => $cours,
    //         'currentFilter' => $filter,
    //         'currentPage' => $page,
    //         'totalPages' => $totalPages,
    //         'semestres' => $semestres,
    //         'modules' => $modules,
    //         'currentSemestre' => $semestreId,
    //         'currentModule' => $moduleId
    //     ]);
    // }




    public function listeCours() {
        $user = $this->session->get('user');
        if (!$user) {
            $this->redirect('login');
            return;
        }

        $userId = $user->getId();
        $userRole = $user->getRole();

        $filter = $_GET['filter'] ?? 'all';
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 3;
        $semestreId = $_GET['semestre'] ?? null;
        $moduleId = $_GET['module'] ?? null;

        $result = null;

        if ($userRole === 'ROLE_PROFESSEUR') {
            $professeur = $this->professeurModel->getProfesseurByUserId($userId);
            if ($professeur) {
                $result = $this->coursModel->getCoursForProfesseur($professeur['id'], $filter, $page, $perPage, $semestreId, $moduleId);
            }
        } else {
            // Supposons que tous les autres rôles sont des étudiants pour simplifier
            $etudiant = $this->etudiantModel->getEtudiantByUserId($userId);
            if ($etudiant) {
                $result = $this->coursModel->getCoursForEtudiant($etudiant['id'], $filter, $page, $perPage, $semestreId, $moduleId);
            }
        }

        if (!$result) {
            $this->redirect('home');
            return;
        }

        $cours = $result['cours'];
        $totalCount = $result['totalCount'];
        $totalPages = ceil($totalCount / $perPage);

        $semestres = $this->coursModel->getAllSemestres();
        $modules = $this->coursModel->getAllModules();

        $this->renderView('listecours', [
            'cours' => $cours,
            'currentFilter' => $filter,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'semestres' => $semestres,
            'modules' => $modules,
            'currentSemestre' => $semestreId,
            'currentModule' => $moduleId,
            'userRole' => $userRole
        ]);
    }
}