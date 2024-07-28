<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Core\Route;

require_once '../vendor/autoload.php';

$route = new Route();
$route->get('login', 'UtilisateurController=>login');
$route->post('login', 'UtilisateurController=>login');
$route->get('logout', 'UtilisateurController=>logout');


$route->get('cours/#filter#', 'CoursController=>listeCours');
// $route->get('cours', 'CoursController=>listeCours');

$route->get('sessions/#filter#', 'SessionController=>listeSessions');
$route->post('sessions', 'SessionController=>listeSessions');
// routes.php

$route->get('absence', 'AbsenceController=>showAbsences');

$route->post('/session/demande-annulation', 'SessionController=>demandeAnnulation');





$route->dispatch();

// var_dump($route);