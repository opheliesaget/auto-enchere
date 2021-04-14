<?php

/**
 * views/contact.php - Vue connect
 */

/* Namespace */

namespace App\Views;


/**
 * Vue Home
 */
class Connect
{
    /**
     * Fonction d'affichage, avec en paramètre la date d'aujourd'hui et
     * la liste contenant les annonces existantes
     */
    public function render($success_connection)
    { ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Enchères</title>
            <link rel="stylesheet" type="text/css" href="assets/styles/style.css?ts=<?= time() ?>" />
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        </head>

        <body>
            <div class="navbarContainer">
                <div class="navbar">
                    <div class="logo">
                        <h1>Bienvenue sur Auto-enchère</h1>
                        <h3>Le site d'enchère de voiture d'occasion</h3>
                    </div>
                    <p> <a href="/enchere/">Home</a> </p>
                </div>
            </div>
            <div class="flex">
                <div id="connection">
                    <h3>Connectez-vous</h3>
                    <form action="traitement-connect" method="POST">
                        <div class="lineForm">
                            <label for="user_mail">Adresse email</label>
                            <input type="email" id="user_mail" name="user_mail" required>
                        </div>
                        <div class="lineForm">
                            <label for="user_password">Mot de passe</label>
                            <input type="password" id="user_password" name="user_password" required>
                        </div>
                        <div class="btn">
                            <input type="submit" value="Me connecter">
                        </div>
                    </form>
                </div>
                <div id="inscription">
                    <h3>Vous n'êtes pas inscrit ? Inscrivez-vous</h3>
                    <form action="traitement-inscription" method="POST">
                        <div class="lineForm">
                            <label for="lastname">Nom</label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                        <div class="lineForm">
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                        <div class="lineForm">
                            <label for="mail">Adresse email</label>
                            <input type="email" id="mail" name="mail" required>
                        </div>
                        <div class="lineForm">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" minlength="8" required>
                        </div>
                        <div class="btn">
                            <input type="submit" value="Inscription">
                        </div>
                    </form>
                </div>
                <?php
                if ($success_connection === 'false') { ?>
                    <div>
                        <p>Erreur Identifiant / Mot de passe.</p>
                        <p>Veuillez réessayer.</p>
                    </div>
                <?php }
                ?>
            </div>
            <footer>
                &copy;Auto-enchère - OS
            </footer>
        </body>

        </html>
<?php }
}
