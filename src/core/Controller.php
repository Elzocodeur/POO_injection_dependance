<?php
namespace App\Core;

use App\Config\ProviderServices;
use App\Core\Validator\ValidatorInterface;
use App\Core\SessionInterface;

abstract class Controller {
    protected $validator;
    protected $session;

    public function __construct(ValidatorInterface $validator, SessionInterface $session) {
        $this->validator = $validator;
        $this->session = $session;
        if ($this->session) {
            $this->session->start();
        }
    }

    // protected function renderView($view, $data = []) {
    //     extract($data);
    //     require_once __DIR__ . "/../../views/{$view}.html.php";
    // }
    protected function renderView($view, $data = [])
{
    extract($data);
    $viewPath = __DIR__ . "/../../views/{$view}.html.php";
    if (!file_exists($viewPath)) {
        throw new \Exception("Vue non trouvée : {$viewPath}");
    }
    require $viewPath;
}

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}