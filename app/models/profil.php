<?php

/**
 * models/profil.php - Modèle de Profil
 */

/* Namespace */

namespace App\Models;

use \PDO;


/**
 * Modèle Profil
 */
class Profil
{
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $dbh;

    public function __construct($id, $firstname, $lastname, $email, $password, $dbh)
    {
        $this->id = $id;
        $this->firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
        $this->lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->dbh = $dbh;
    }
    public function __get($property)
    {
        return $this->$property;
    }
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    /**
     * Requetes pour modifier les informations du user
     */
    public function modif_firstname_request($email)
    {
        $query = $this->dbh->prepare("UPDATE `users` SET `firstname`= ? WHERE email ='$email'");
        $query->execute([$this->firstname]);
    }
    public function modif_lastname_request($email)
    {
        $query = $this->dbh->prepare("UPDATE `users` SET `lastname`= ? WHERE email ='$email'");
        $query->execute([$this->lastname]);
    }
    public function modif_password_request($email)
    {
        $query = $this->dbh->prepare("UPDATE `users` SET `password`= ? WHERE email ='$email'");
        $query->execute([$this->password]);
    }


    /**
     * Requete pour récuperer les infos du user connecté
     */
    public static function getUserConnected($email, $dbh)
    {
        return $dbh->query("SELECT * FROM users WHERE email = '$email'")->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Requete pour récuperer les enchères du user connecté
     */
    public static function callAllAd($id, $dbh)
    {
        return $dbh->query("SELECT * FROM ad WHERE user_win =" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Requete pour récuperer les annonces créées par user connecté
     */
    public static function callAllAdCreated($id, $dbh)
    {
        return $dbh->query("SELECT * FROM ad WHERE user_creator =" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }
}
