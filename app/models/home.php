<?php

/**
 * models/home.php - Modèle de HOME __et__ Modèle de ad-page
 */

/* Namespace */

namespace App\Models;

use \PDO;


/**
 * Modèle Home
 */
class Home
{
    protected $id;
    protected $price;
    protected $end_date;
    protected $brand;
    protected $modele;
    protected $power;
    protected $years;
    protected $description;
    protected $user_win;
    protected $user_creator;
    protected $dbh;

    /* Construct */
    public function __construct($id, $price, $end_date, $brand, $modele, $power, $years, $description, $user_win, $user_creator, $dbh)
    {
        //Nettoyage des données
        $this->id = $id;
        $this->price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
        $this->end_date = filter_var($end_date, FILTER_SANITIZE_STRING);
        $this->brand = filter_var($brand, FILTER_SANITIZE_STRING);
        $this->modele = filter_var($modele, FILTER_SANITIZE_STRING);
        $this->power = filter_var($power, FILTER_SANITIZE_NUMBER_INT);
        $this->years = filter_var($years, FILTER_SANITIZE_NUMBER_INT);
        $this->description = filter_var($description, FILTER_SANITIZE_STRING);
        $this->user_win = $user_win;
        $this->user_creator = $user_creator;
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

    /** 
     * Requete POST pour la création d'une annonce
     */
    public function create_ad()
    {
        $query = $this->dbh->prepare("INSERT INTO ad (price, end_date, brand, modele, power, years, description, user_creator) VALUES (?,?,?,?,?,?,?,?)");
        $query->execute([$this->price, $this->end_date, $this->brand, $this->modele, $this->power, $this->years, $this->description, $this->user_creator]);
        header('Location: /enchere/');
    }

    /**
     * Requetes pour modifier le user_win et le prix lors d'une enchère (AD-PAGE)
     */
    public function modif_price_request($id)
    {
        $query = $this->dbh->prepare("UPDATE `ad` SET `user_win`= ?  WHERE id =" . $id);
        $query->execute([$this->user_win]);
        $query = $this->dbh->prepare("UPDATE `ad` SET `price`= ?WHERE id =" . $id);
        $query->execute([$this->price]);
    }

    /**
     * Requete pour récuperer les annonces existantes
     */
    public static function callAllAd($dbh)
    {
        $result = $dbh->query("SELECT * FROM ad")->fetchAll(PDO::FETCH_ASSOC);
        $contact = [];
        foreach ($result as $result) {
            array_push($contact, new Home($result['id'], $result['price'], $result['end_date'], $result['brand'], $result['modele'], $result['power'], $result['years'], $result['description'], $result['user_win'], $result['user_creator'], $dbh));
        }
        return $contact;
    }
    /**
     * Requete pour récuperer les annonces existantes
     */
    public static function callAdById($id, $dbh)
    {
        $result = $dbh->query("SELECT * FROM ad WHERE id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
        $contact = [];
        foreach ($result as $result) {
            array_push($contact, new Home($result['id'], $result['price'], $result['end_date'], $result['brand'], $result['modele'], $result['power'], $result['years'], $result['description'], $result['user_win'], $result['user_creator'], $dbh));
        }
        return $contact;
    }
    /**
     * Requete pour récuperer les infos du user connecté
     */
    public static function getUserConnected($email, $dbh)
    {
        return $dbh->query("SELECT `firstname` FROM users WHERE email = '$email'")->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Requete pour récuperer les infos du user connecté
     */
    public static function getIdUserConnected($email, $dbh)
    {
        return $dbh->query("SELECT `id` FROM users WHERE email = '$email'")->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Requete pour récuperer les infos du user connecté
     */
    public static function getUserById($id, $dbh)
    {
        return $dbh->query("SELECT `firstname`, `lastname`, `email` FROM users WHERE id = " . $id)->fetchAll(PDO::FETCH_ASSOC);
    }
}
