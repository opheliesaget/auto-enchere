<?php

/**
 * controllers/default.php - Controleur accueil pour la page par défaut
 */

/* Namespace */

namespace App\Controllers;

class DefaultPage
{

    /**
     * Affichage de la page par défaut
     */
    public function render()
    {
        http_response_code(404);

?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="utf-8">
            <title>Enchère</title>

            <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
        </head>

        <body>
            <div id="mainContainer">
                <h1>Page non trouvée</h1>
                <p>Cette page n'existe pas.</p>
            </div>
        </body>

        </html>
<?php
    }
}
