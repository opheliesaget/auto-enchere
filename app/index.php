<?php

/**
 * index.php - Point d'entrée de l'application
 * C'est ici que l'on défini les routes 
 * et les fonctions des controleurs qui dervont être appelées
 */

/* Imports */
require_once __DIR__ . "/core/Router.class.php"; // Routeur
include_once __DIR__ . "/controllers/home.php";
include_once __DIR__ . "/controllers/default.php";
include_once __DIR__ . "/controllers/ad-page.php";
include_once __DIR__ . "/controllers/connect.php";
include_once __DIR__ . "/controllers/profil.php";

use App\Router\Router;
use App\Controllers\Home;
use App\Controllers\DefaultPage;
use App\Controllers\Connect;
use App\Controllers\Ad_page;
use App\Controllers\Profil;


/**
 * Requête
 */
$method = $_SERVER['REQUEST_METHOD']; // Récupération du verbe
$uri = $_GET['uri']; // Récuépération de l'URI


/**
 * Router
 */

/* Création du routeur */
$router = new Router($uri, $method);


/**
 * Routes
 */

/* GET / - Page d'accueil */
$router->get("/",  [new Home(), 'render']);
$router->post("/traitement",  [new Home(), 'form']);
$router->get("/deconnexion",  [new Home(), 'deconnexion']);

$router->get("/connexion",  [new Connect(), 'render']);
$router->post("/traitement-inscription",  [new Connect(), 'add_new_user']);
$router->post("/traitement-connect",  [new Connect(), 'connection']);

$router->get("/ad-page",  [new Ad_page(), 'render']);
$router->post("/traitement-ad",  [new Ad_page(), 'ad_enchere_request']);

$router->get("/profil",  [new Profil(), 'render']);
$router->post("/update",  [new Profil(), 'update_request']);



/* Route par défaut */
$router->default([new DefaultPage(), 'render']);



/**
 * Recherche de routes correspondantes
 */

/* Démarrage du routeur */
$router->start();
