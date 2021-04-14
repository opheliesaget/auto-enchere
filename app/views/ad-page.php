<?php

/**
 * views/contact.php - Vue conact
 */

/* Namespace */

namespace App\Views;


/**
 * Vue Home
 */
class AdPage
{

    /**
     * Fonction d'affichage, avec en paramètre la date d'aujourd'hui et
     * la liste contenant les annonces existantes
     */
    public function render($is_connected, $user_win_info, $ads, $id_ad, $user_creator_info, $its_my_ad, $id_connected, $user_win)
    { ?>
        <!DOCTYPE html>
        <html lang="fr">

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
                    <div id="connectUser">
                        <?php if ($is_connected) { ?>
                            <p> <a href="/enchere/profil">Mon compte</a> </p>
                        <?php } ?>
                        <p> <a href="/enchere/">Home</a> </p>
                    </div>
                </div>
            </div>
            <div id="adPageContent">
                <?php
                foreach ($ads as $index => $array) { ?>
                    <div class="adpage">
                        <h3> Annonce <?php echo $array->id ?></h3>
                        <div id="contentAdPage">
                            <p>Marque : <?php echo $array->brand ?></p>
                            <p>Modèle : <?php echo $array->modele ?></p>
                            <p>Puissance : <?php echo $array->power ?></p>
                            <p>Année : <?php echo $array->years ?></p>
                            <p>Description : <?php echo $array->description ?></p>
                            <p>Prix : <?php echo $array->price ?></p>
                            <p class="date">Date de fin des enchères : <?php echo $array->end_date ?></p>

                            <?php
                            //Possibilité d'enchérir SI la date d'enchère est pas dépassée
                            $today = date('Y-m-d');
                            if ($today <= $array->end_date) {
                                if ($array->user_win != null) {
                                    foreach ($user_win_info as $list) {
                                        if ($id_connected == $user_win) {
                                            echo "<p class='color size center'>Vous est en tête de l'enchère !</p>";
                                        } else { ?>
                                            <p class='color size center'><?php echo ucfirst($list['firstname']) . ' ' . ucfirst($list['lastname']) ?> est en tête de l'enchère !</p>
                                    <?php }
                                    }
                                } else {
                                    echo "<p>Aucun enchérisseur pour le moment.</p>";
                                }
                                if ($is_connected and $its_my_ad) { ?>
                                    <p class='size center color'>Vous avez créé cette annonce.</p>
                                <?php } else if ($is_connected and $id_connected != $user_win) {
                                ?>
                                    <form action="traitement-ad?id=<?php echo $id_ad ?>" method="POST" id="adEnchere">
                                        <div class="btn inputEnchere">
                                            <input type="number" min='<?php echo $array->price ?>' id='new_enchere' name="new_enchere" value='<?php echo $array->price + 50 ?>'>
                                        </div>
                                        <div class="btn">
                                            <form action="" method="POST">
                                                <input type="submit" value="Ajouter une enchère">
                                            </form>
                                        </div>

                                    </form>
                                <?php
                                } else if ($is_connected == false) { ?>
                                    <p class='size center' id="connect"> <a href="connexion">Connectez-vous ici</a> pour enchérir</p>
                                    <?php }

                                //Sinon on affiche le gagnant de l'enchère
                            } else {
                                if ($array->user_win != null) {
                                    foreach ($user_win_info as $array) { ?>
                                        <p class='color size center'>Félicitation à <?php echo ucfirst($array['firstname']) . ' ' . ucfirst($array['lastname']) ?> pour avoir remporté cette enchère !</p>
                            <?php }
                                } else {
                                    echo "<p>Personne n'a remporté cette enchère.</p>";
                                }
                            }
                            ?>
                        </div>
                        <?php if ($its_my_ad == false) { ?>
                            <div id="infoSeller">
                                <h4 id="btnInfoSeller">Obtenir les informations du vendeur</h4>
                                <?php foreach ($user_creator_info as $list) { ?>
                                    <div id="infoSellerHide" style="display:none">
                                        <p><?php echo ucfirst($list['firstname']) . " " . ucfirst($list['lastname']) ?></p>
                                        <p>Adresse email : <?php echo ucfirst($list['email']) ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php
                } ?>
            </div>
            <footer>
                &copy;Auto-enchère - OS
            </footer>
            <!--Script app-->
            <script type="text/javascript" src="assets/styles/app-ad-page.js?ts=<?= time() ?>"></script>
        </body>

        </html>
<?php }
}
