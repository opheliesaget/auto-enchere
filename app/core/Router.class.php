<?php

/**
 * routes/Router.class.php - Classe router
 * Cette classe permet de créer un nouveau router.
 * Le routeur est chargé d'enregistrer les différentes routes possibles
 * et de les vérifier.
 */

/* Namespace */

namespace App\Router;


/* Imports */

require_once __DIR__ . "/Route.class.php";


/**
 * Classe Routeur
 */
class Router
{

    /* Propriétés */
    protected $uri; // URI de la requête reçue
    protected $method; // Verbe de la requête reçue
    protected $routes = [
        "GET" => [],
        "POST" => []
    ]; // Routes enregistrées dans 2 tableau selon leur verbe
    protected $not_found_callback; // Fonction callback à appeler si aucune route ne correspond

    /**
     * Constructeur
     */
    public function __construct($uri, $method)
    {
        $this->uri = trim($uri, "/"); // Suppression des / en début et fin d'URI
        $this->method  = $method;
    }

    /**
     * Enregistrement d'une route avec le verbe GET
     */
    public function get($path, $callback)
    {
        $route = new Route($path, $callback); // Création d'une nouvelle route
        $this->routes["GET"][] = $route; // Ajout de l'instance de Route dans la liste des routes GET
    }

    /**
     * Enregistrement d'une route avec le verbe POST
     */
    public function post($path, $callback)
    {
        $route = new Route($path, $callback); // Création d'une nouvelle route
        $this->routes["POST"][] = $route; // Ajout de l'instance de Route dans la liste des routes POST
    }

    /**
     * Enregistrement de la fonction par défaut
     */
    public function default($callback)
    {
        $this->not_found_callback = $callback;
    }


    /**
     * Démarrage de la recherche d'une route correspondante
     */
    public function start()
    {

        /* On boucle sur le tableau contenant les routes du verbe de la requeêt reçue */
        foreach ($this->routes[$this->method] as $route) {

            /* Vérification de la route */
            if ($route->check($this->uri)) {
                $route->call(); // Appel de la fonction callback de la route
                return; // Arrêt de la fonction
            }
        }

        /* 
         * Si on arrive a cette étape, aucune route ne correspond, 
         * on appelle donc la fonction callback par défaut
         */
        if (isset($this->not_found_callback)) {
            call_user_func($this->not_found_callback); // Appel de la focntion callback par défaut
        }
    }
}
