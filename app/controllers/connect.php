<?php

/**
 * controllers/connect.php - Controleur pour la page de connexion
 */

/* Namespace */

namespace App\Controllers;

/* Import */

include_once __DIR__ . '/../core/Database.class.php';
include_once __DIR__ . '/../models/connect.php';
include_once __DIR__ . '/../views/connect.php';

use App\Database\Database;
use App\Views\Connect as ConnectView;
use App\Models\Connect as ConnectModel;

class Connect
{
    public $success_connection;

    /**
     * Requete post pour créer un nouveau user
     */
    public function add_new_user()
    {
        //Création de connection à la base de donnée
        $dbh = Database::createDBConnection();
        //Instanciation de la class HomeModel, avec les données du formulaire 
        $ConnectModel = new ConnectModel($_POST["lastname"], $_POST["firstname"], $_POST["mail"], $_POST["password"], $dbh);
        /* Validation */
        $data_validated = true;
        if (filter_var($ConnectModel->mail, FILTER_VALIDATE_EMAIL) === false) {
            $data_validated = false;
        }
        /**
         * Requête si nettoyage et validation des donénes OK
         */
        if ($data_validated) {
            $ConnectModel->add_user_request();
        }
    }

    public function connection()
    {
        /*Nettoyage des données saisies*/
        $email = filter_var($_POST['user_mail'], FILTER_SANITIZE_EMAIL);
        /* Validation des données*/
        $data_validated = true;
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $data_validated = false;
        }
        if ($data_validated) {
            $dbh = Database::createDBConnection();
            $user_list = ConnectModel::user_connection($dbh);
            foreach ($user_list as $list) {
                if ($email == $list['email']) {
                    if (password_verify($_POST['user_password'], $list['password'])) {
                        $this->success_connection = true;
                        session_start();
                        $_SESSION["newsession"] = $list['email'];
                        break;
                    } else {
                        echo 'nok';
                        $this->success_connection = false;
                        header('Location: /enchere/connexion');
                        break;
                    }
                } else {
                    echo 'nok';
                    $this->success_connection = false;
                }
            }
            if ($this->success_connection == false) {
                header('Location: /enchere/connexion?connect=false');
            } else {
                header('Location: /enchere/');
            }
        }
    }

    /**
     * Affichage de la page de connexion
     */
    public function render()
    {
        if (isset($_GET['connect'])) {
            $success = $_GET['connect'];
        } else {
            $success = true;
        }
        $ConnectView = new ConnectView();
        $ConnectView->render($success);
    }
}
