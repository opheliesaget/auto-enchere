<?php

/**
 * models/connect.php - Modèle de la page de connexion
 */

/* Namespace */

namespace App\Models;

use \PDO;


/**
 * Modèle Home
 */
class Connect
{
    protected $lastname;
    protected $firstname;
    protected $mail;
    protected $password;
    protected $dbh;

    public function __construct($lastname, $firstname, $mail, $password, $dbh)
    {
        //Nettoyage des données
        $this->lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
        $this->firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
        $this->mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        //Hachage du MDP
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->dbh = $dbh;
    }

    /* Get */
    public function __get($property)
    {
        return $this->$property;
    }
    /* Set */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    public function add_user_request()
    {
        $query = $this->dbh->prepare("INSERT INTO users (lastname, firstname, email, password) VALUES (?,?,?,?)");
        $query->execute([$this->lastname, $this->firstname, $this->mail, $this->password]);
        //print_r($query->errorInfo()); // pour afficher erreur PDO
        //var_dump($result);
        header('Location: /enchere/');
    }

    public static function user_connection($dbh)
    {
        return $dbh->query("SELECT `email`, `password` FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }
}
