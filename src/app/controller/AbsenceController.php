<?php

namespace App\App\Controller;

use App\Core\Controller;
use App\App\Model\AbsenceModel;
use App\Core\SessionInterface;
use App\Core\Validator\ValidatorInterface;
use App\App\Model\EtudiantModel;

class AbsenceController extends Controller {
    private AbsenceModel $absenceModel;
    private EtudiantModel $etudiantModel;

    public function __construct(AbsenceModel $absenceModel, EtudiantModel $etudiantModel, ValidatorInterface $validator, SessionInterface $session)
    {
        parent::__construct($validator, $session);
        $this->absenceModel = $absenceModel;
        $this->etudiantModel = $etudiantModel;
    }

    public function showAbsences()
{
    $user = $this->session->get('user');
    if (!$user) {
        $this->redirect('login');
        return;
    }

    if ($user->getRole() === 'ROLE_ETUDIANT') {
        $etudiant = $this->etudiantModel->getEtudiantByUserId($user->getId());
        if ($etudiant) {
            $absences = $this->absenceModel->getAbsencesByStudentId($etudiant['id']);
            return $this->renderView('absence', ['absences' => $absences]);
        }
    }

    $this->redirect('homepage');
}
}