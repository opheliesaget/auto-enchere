<?php

/**
 * routes/Route.class.php - Classe route
 * Cette classe permet de créer une nouvelle route.
 * Cette route sera enregistrée dans le routeur.
 */

/* Namespace */

namespace App\Router;


/**
 * Classe route
 */
class Route
{

    /* Propriétés */
    protected $path; // Chemin de la route
    protected $callback; // Fonction callback à appeler si la route correspond


    /**
     * Constructeur
     */
    public function __construct($path, $callback)
    {
        $this->path = trim($path, "/"); // Suppression des / en début et fin d'URI
        $this->callback = $callback;
    }

    /**
     * Vérification de la route
     */
    public function check($uri)
    {
        return $uri === $this->path;
    }

    /**
     * Appel de la fonction callback de la route
     */
    public function call()
    {
        call_user_func($this->callback); // Appel la fonction callback stokée dans la propriété
    }
}
