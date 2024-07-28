<?php

namespace App\App;

use App\Core\Database\MysqlDatabase;
use Dotenv\Dotenv;

class App {
    private static $instance;
    private $database;

    private function __construct() {
        // Le constructeur est privé pour empêcher l'instanciation directe
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getDatabase() {
        if ($this->database === null) {
            $configPath = __DIR__ . '/../../config.php';
            if (!file_exists($configPath)) {
                throw new \Exception("Le fichier de configuration n'existe pas : $configPath");
            }
            require_once $configPath;

            if (!defined('DSN') || !defined('DB_USER') || !defined('DB_PASSWORD')) {
                throw new \Exception("Les constantes de base de données ne sont pas définies dans le fichier de configuration.");
            }

            $this->database = new MysqlDatabase(DSN, DB_USER, DB_PASSWORD);
        }
        return $this->database;
    }

    public function getModel($model) {
        $modelClass = "App\\App\\Model\\" . ucfirst($model) . "Model";
        if (!class_exists($modelClass)) {
            throw new \Exception("La classe modèle $modelClass n'existe pas.");
        }
        return new $modelClass($this->getDatabase());
    }

    public static function notFound() {
        $viewPath = __DIR__ . "/../../views/notFound.html.php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "404 - Page non trouvée";
        }
    }

    public function forbidden() {
        // Implémentez la logique pour la page d'accès interdit
        echo "403 - Accès interdit";
    }
}