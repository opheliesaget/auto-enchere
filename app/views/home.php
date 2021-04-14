<?php

/**
 * views/home.php - Vue de la page HOME
 */

/* Namespace */

namespace App\Views;


/**
 * Vue Home
 */
class Home
{
    /**
     * Fonction d'affichage, avec en paramètre la date d'aujourd'hui et
     * la liste contenant les annonces existantes
     */
    public function render($connected, $user, $today, $in_progress, $finished)
    { ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="utf-8">
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
                    <?php if ($connected === true) { ?>
                        <p class='name'>Bonjour <?php echo ucfirst($user) ?> </p>
                        <div id="connectUser">
                            <p><a href="profil">Mon compte </a></p>
                            <p><a href="deconnexion">Deconnexion</a> </p>
                        </div>
                    <?php } else { ?>
                        <p> <a href="connexion">Connexion</a> </p>
                    <?php } ?>
                </div>
            </div>
            <div class="content">
                <div id="createAd">
                    <h3 id="addAd">Ajouter une annonce</h3>
                    <?php if ($connected === true) { ?>
                        <form action="traitement" method="POST">
                            <div class="lineForm">
                                <label for="price">Prix de reserve</label>
                                <input type="number" id="price" name="price" required>
                                <p>€</p>
                            </div>
                            <div class="lineForm">
                                <label for="end_date">Date de fin des enchères</label>
                                <input type="date" id="end_date" name="end_date" value="<?php echo $today ?>" min="<?php echo $today ?>" max="2021-06-31">
                            </div>
                            <div class="lineForm">
                                <label for="brand">Marque de la voiture</label>
                                <input type="text" id="brand" name="brand" required>
                            </div>
                            <div class="lineForm">
                                <label for="modele">Modele de la voiture</label>
                                <input type="text" id="modele" name="modele" required>
                            </div>
                            <div class="lineForm">
                                <label for="power">Puissance</label>
                                <input type="number" id="power" name="power" required>
                                <p>ch</p>
                            </div>
                            <div class="lineForm">
                                <label for="years">Année</label>
                                <input type="number" id="years" name="years" required>
                            </div>
                            <div class="lineForm">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="4"></textarea>
                            </div>
                            <div class="btn">
                                <input type="submit" value="Ajouter">
                                <p id="annuler">Annuler</p>
                            </div>
                        </form>
                    <?php } else { ?>
                        <p> <a href="connexion">Connectez-vous ici</a> pour ajouter une annonce</p>
                    <?php } ?>
                </div>
                <h2>Les annonces</h2>
                <div id="displayAd">

                    <div class="filterAd">
                        <h3>Enchères en cours</h3>
                        <?php
                        $ads_reverse_progress = array_reverse($in_progress, true);
                        foreach ($ads_reverse_progress as $index => $value) {
                        ?>
                            <div class="ad">
                                <h4>Annonce <?php echo $value->id ?></h4>
                                <div class="contentAd">
                                    <p>Marque : <?php echo $value->brand ?></p>
                                    <p>Modèle : <?php echo $value->modele ?></p>
                                    <p>Prix : <?php echo $value->price ?> €</p>
                                    <p>Date de fin des enchères : <?php echo $value->end_date ?></p>
                                    <p class="linkAd"><a href="ad-page?id=<?php echo $value->id ?>">Cliquez ici</a> pour plus d'informations</p>
                                </div>
                            </div>
                        <?php

                        }
                        ?>
                    </div>
                    <div class="filterAd">
                        <h3>Enchères terminées</h3>
                        <?php
                        $ads_reverse_finished = array_reverse($finished, true);
                        foreach ($ads_reverse_finished as $index => $val) {
                        ?>
                            <div class="ad">
                                <h4>Annonce <?php echo $val->id ?></h4>
                                <div class="contentAd">
                                    <p>Marque : <?php echo $val->brand ?></p>
                                    <p>Modèle : <?php echo $val->modele ?></p>
                                    <p>Prix : <?php echo $val->price ?> €</p>
                                    <p>Date de fin des enchères : <?php echo $val->end_date ?></p>
                                    <p class="linkAd"><a href="ad-page?id=<?php echo $val->id ?>">Cliquez ici</a> pour plus d'informations</p>
                                </div>
                            </div>
                        <?php

                        }
                        ?>
                    </div>

                </div>
            </div>
            <footer>
                &copy;Auto-enchère - OS
            </footer>
            <!--Script app-->
            <script type="text/javascript" src="assets/styles/app.js"></script>
        </body>

        </html>

<?php }
}
