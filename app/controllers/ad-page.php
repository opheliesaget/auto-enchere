<?php

/**
 * controllers/ad-page.php - Controleur pour la page des annonces
 */

/* Namespace */

namespace App\Controllers;

/* Imports */

include_once __DIR__ . '/../core/Database.class.php';
include_once __DIR__ . '/../models/home.php';
include_once __DIR__ . '/../views/ad-page.php';

use App\Database\Database;
use App\Views\AdPage as AdPageView;
use App\Models\Home as HomeModel;

class Ad_page
{
    /*Requete pour ajouter une enchère - TRAITEMENT FORMULAIRE
    Modification user_win, modification du prix*/
    public function ad_enchere_request()
    {
        //Création de connection
        $dbh = Database::createDBConnection();
        //Récupération de l'id de l'annonce (via l'url)
        $id = $_GET['id'];
        //Récupération de l'id du user connecté
        session_start();
        $user_id = HomeModel::getIdUserConnected($_SESSION["newsession"], $dbh);

        $HomeModel = new HomeModel(null, $_POST['new_enchere'], null, null, null, null, null, null, $user_id[0]['id'], null, $dbh);
        var_dump($HomeModel);
        $HomeModel->modif_price_request($id);

        header('Location: /enchere/ad-page?id=' . $id);
    }

    /**
     * Affichage de la page de l'annonce sélectionnée
     */
    public function render()
    {
        //Vérification de session
        session_start();
        if (isset($_SESSION["newsession"])) {
            $is_connected = true;
        } else {
            $is_connected = false;
        }

        //Récupération de l'id de l'annonce (via l'url)
        $id = $_GET['id'];

        //Création de connection à la base de donnée
        $dbh = Database::createDBConnection();

        //Appel de la requete dans modele qui récupère les annonces
        $ad_array = HomeModel::callAdById($id, $dbh);

        //Récupération des données du gagnant (ou du dernier user à avoir enchéri)
        $user_win = $ad_array[0]->user_win;
        if ($user_win != null) {
            $user_win_info = HomeModel::getUserById($user_win, $dbh);
        } else {
            $user_win_info = null;
        }

        //Récupération des données du user qui a créé l'annonce
        $user_creator = $ad_array[0]->user_creator;
        if ($user_creator != null) {
            $user_creator_info = HomeModel::getUserById($user_creator, $dbh);
        } else {
            $user_creator_info = null;
        }

        //Vérification du cas ou le user connecté va sur une annonce qu'il a créé
        $id_user_connected = HomeModel::getIdUserConnected($_SESSION["newsession"], $dbh);
        if ($ad_array[0]->user_creator == $id_user_connected[0]['id']) {
            $its_my_ad = true;
        } else {
            $its_my_ad = false;
        }

        //Récupération du id connecté
        $id_connected = $id_user_connected[0]['id'];

        //Création d'une instante HomeView et appel de la fonction d'affichage
        $AdPageView = new AdPageView();
        $AdPageView->render($is_connected, $user_win_info, $ad_array, $id, $user_creator_info, $its_my_ad, $id_connected, $user_win);
    }
}
