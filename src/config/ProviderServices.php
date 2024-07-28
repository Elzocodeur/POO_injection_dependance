<?php
namespace App\Config;

use Symfony\Component\Yaml\Yaml;
use App\Core\Validator\ValidatorInterface;
use App\Core\SessionInterface;
use App\App\App; //

class ProviderServices {
    private static $instance;
    private $services = [];
    private $config;

    private function __construct()
    {
        $this->loadConfig();
    }

    private function loadConfig()
    {
        $configPath = '/var/www/html/pedagogie/src/config/Services.yaml';
        if (!file_exists($configPath)) {
            throw new \Exception("Le fichier de configuration n'existe pas : $configPath");
        }
        $this->config = Yaml::parseFile($configPath);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getService($serviceName)
    {
        if (!isset($this->services[$serviceName])) {
            if (!isset($this->config['Services'][$serviceName])) {
                throw new \Exception("Service non configuré : $serviceName");
            }
            $className = $this->config['Services'][$serviceName]['class'];
            if (!class_exists($className)) {
                throw new \Exception("Classe non trouvée pour le service $serviceName : $className");
            }
            
            if (is_subclass_of($className, 'App\Core\Model\Model')) {
                $app = App::getInstance();
                $database = $app->getDatabase();
                $this->services[$serviceName] = new $className($database);
            } else {
                $this->services[$serviceName] = new $className();
            }
        }
        return $this->services[$serviceName];
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->getService(ValidatorInterface::class);
    }

    public function getSession(): SessionInterface
    {
        return $this->getService(SessionInterface::class);
    }
}