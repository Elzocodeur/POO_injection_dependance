<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\Model\UtilisateurModel;
use App\Core\Validator\ValidatorInterface;
use App\Core\SessionInterface;

class UtilisateurController extends Controller {
    private $utilisateurModel;
    
    public function __construct(UtilisateurModel $utilisateurModel, ValidatorInterface $validator, SessionInterface $session) {
        parent::__construct($validator, $session);
        $this->utilisateurModel = $utilisateurModel;
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];
            
            $utilisateur = $this->utilisateurModel->findByLogin($login);
            
            // Vérifiez si $utilisateur est un objet et s'il a la méthode getPassword()
            if ($utilisateur && method_exists($utilisateur, 'getPassword') && password_verify($password, $utilisateur->getPassword())) {
                $this->session->set('user', $utilisateur);
                $this->redirect('cours/filter'); // Redirection vers un tableau de bord
            } else {
                $this->renderView('login', ['error' => 'Login ou mot de passe incorrect']);
            }
        } else {
            $this->renderView('login');
        }
    }
    

    
    public function logout() {
        $this->session->destroy();
        $this->redirect('login');
    }
}