<?php

/**
 * controllers/profil.php - Controleur pour la page personnelle du user connecté
 */

/* Namespace */

namespace App\Controllers;

/*Imports*/

include_once __DIR__ . '/../core/Database.class.php';
include_once __DIR__ . '/../models/profil.php';
include_once __DIR__ . '/../views/profil.php';

use App\Database\Database;
use App\Views\Profil as ProfilView;
use App\Models\Profil as ProfilModel;

/**
 * Classe Profil
 */
class Profil
{
    /**
     * Modification du compte
     */
    public function update_request()
    {
        /*Création de connection à la base de donnée*/
        $dbh = Database::createDBConnection();
        //Instanciation de la class HomeModel, avec les données du formulaire 
        $ProfilModel = new ProfilModel(null, $_POST["firstname"], $_POST["lastname"], null, $_POST["password"], $dbh);
        //Récupération de l'email du user connecté 
        session_start();
        $user_mail = $_SESSION["newsession"];

        //On fait des requête seulement pour les champs non vide
        if ($ProfilModel->firstname != "") {
            $ProfilModel->modif_firstname_request($user_mail);
        }
        if ($ProfilModel->lastname != "") {
            $ProfilModel->modif_lastname_request($user_mail);
        }
        if ($ProfilModel->password != "") {
            $ProfilModel->modif_password_request($user_mail);
        }
        header('Location: /enchere/profil');
    }

    /**
     * Affichage de la page d'accueil
     */
    public function render()
    {
        /*Création de connection à la base de donnée*/
        $dbh = Database::createDBConnection();

        /*Récupération des données du user connecté*/
        session_start();
        $user_mail = $_SESSION["newsession"];
        $info_array = ProfilModel::getUserConnected($user_mail, $dbh);

        /*Récupération des annonces du users*/
        $user_id = $info_array[0]['id'];
        $ad_array = ProfilModel::callAllAd($user_id, $dbh);
        //Filtrage des enchères (terminée et en cours)
        $today = date('Y-m-d');
        $in_progress = [];
        $finished = [];
        foreach ($ad_array as $list) {
            if ($today <= $list['end_date']) {
                array_push($in_progress, $list);
            } else {
                array_push($finished, $list);
            }
        }

        /*Récupération des annonces créées par le user connecté*/
        $ad_array_created = ProfilModel::callAllAdCreated($user_id, $dbh);
        $in_progress_created = [];
        $finished_created = [];
        foreach ($ad_array_created as $list) {
            if ($today <= $list['end_date']) {
                array_push($in_progress_created, $list);
            } else {
                array_push($finished_created, $list);
            }
        }
        /*Appel de la fonction d'affichage*/
        $ProfilView = new ProfilView();
        $ProfilView->render($info_array, $in_progress, $finished, $in_progress_created, $finished_created);
    }
}
