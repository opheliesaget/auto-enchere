<?php

/**
 * controllers/home.php - Controleur accueil pour la page d'accueil
 */

/* Namespace */

namespace App\Controllers;

/*Imports*/

include_once __DIR__ . '/../core/Database.class.php';
include_once __DIR__ . '/../models/home.php';
include_once __DIR__ . '/../views/home.php';

use App\Database\Database;
use App\Views\Home as HomeView;
use App\Models\Home as HomeModel;

/**
 * Classe Home
 */
class Home
{
    /**
     * Requete de traitement du formulaire de création d'annonce
     */
    public function form()
    {
        //Création de connection à la base de donnée
        $dbh = Database::createDBConnection();
        //Récupération de l'id du user connecté
        session_start();
        $email_user_connected = $_SESSION["newsession"];
        $id_user_connected = HomeModel::getIdUserConnected($email_user_connected, $dbh);
        $id_user = $id_user_connected[0]['id'];
        //Instanciation de la class HomeModel, avec les données du formulaire 
        $HomeModel = new HomeModel(null, $_POST["price"], $_POST["end_date"], $_POST["brand"], $_POST["modele"], $_POST["power"], $_POST["years"], $_POST["description"], null, $id_user, $dbh);
        /**
         * Validation des données
         */
        $data_validated = true;
        if (filter_var($HomeModel->price, FILTER_VALIDATE_INT) === false) {
            $data_validated = false;
        }
        if (filter_var($HomeModel->power, FILTER_VALIDATE_INT) === false) {
            $data_validated = false;
        }
        if (filter_var($HomeModel->years, FILTER_VALIDATE_INT) === false) {
            $data_validated = false;
        }
        /**
         * Requête si nettoyage et validation des donénes OK
         */
        if ($data_validated) {
            $HomeModel->create_ad();
        }
    }
    /**
     * Affichage de la page d'accueil
     */
    public function deconnexion()
    {
        session_start();
        unset($_SESSION["newsession"]);
        header('Location: /enchere/');
    }
    /**
     * Affichage de la page d'accueil
     */
    public function render()
    {
        //Création de connection à la base de donnée
        $dbh = Database::createDBConnection();

        //Affichage du nom du user connecté
        session_start();
        if (isset($_SESSION["newsession"])) {
            $connected = true;
            $result = HomeModel::getUserConnected($_SESSION["newsession"], $dbh);
            $user = $result[0]['firstname'];
        } else {
            $connected = false;
            $user = null;
        }

        //Appel de la requete dans modele qui récupère les annonces
        $ad_array = HomeModel::callAllAd($dbh);


        /*Récupération des annonces du users*/
        //Filtrage des enchères (terminée et en cours)
        $today = date('Y-m-d');
        $in_progress = [];
        $finished = [];
        foreach ($ad_array as $object) {
            if ($today <= $object->end_date) {
                array_push($in_progress, $object);
            } else {
                array_push($finished, $object);
            }
        }
        //Création d'une instante HomeView et appel de la fonction d'affichage
        $HomeView = new HomeView();
        $HomeView->render($connected, $user, $today, $in_progress, $finished);
    }
}
