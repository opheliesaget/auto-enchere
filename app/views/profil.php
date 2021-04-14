<?php

/**
 * views/profil.php - Vue de la page Profil
 */

/* Namespace */

namespace App\Views;


/**
 * Vue Home
 */
class Profil
{
    /**
     * Fonction d'affichage, avec en paramètre la date d'aujourd'hui et
     * la liste contenant les annonces existantes
     */
    public function render($array, $in_progress, $finished, $in_progress_created, $finished_created)
    { ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Enchere</title>
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
            <div class="contentProfil">
                <div id="info">
                    <h3>Mon profil</h3>
                    <div class="flexInfo">
                        <div>
                            <p>Prénom : <?php echo ucfirst($array[0]['firstname']) ?></p>
                            <p>Nom : <?php echo ucfirst($array[0]['lastname']) ?></p>
                            <p>Adresse mail : <?php echo ucfirst($array[0]['email']) ?></p>
                        </div>
                        <p id="modifBtn">Modifier mon profil</p>
                    </div>
                </div>
                <div id="modification" class="test" style="display:none">
                    <h4>Modification de mes informations</h4>
                    <form action="update" method="POST">
                        <div class="lineForm">
                            <label for="lastname">Nom</label>
                            <input type="text" id="lastname" name="lastname" placeholder="<?php echo  ucfirst($array[0]['lastname']) ?>">
                        </div>
                        <div class="lineForm">
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" name="firstname" placeholder="<?php echo ucfirst($array[0]['firstname']) ?>">
                        </div>
                        <div class="lineForm">
                            <label>Adresse email</label>
                            <p><?php echo ucfirst($array[0]['email']) ?></p>
                        </div>
                        <div class="lineForm">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" placeholder="Entrez votre nouveau mdp" minlength="8">
                        </div>
                        <div class="btn">
                            <input type="submit" value="Modifier">
                            <p id="annulermodif">Annuler</p>
                        </div>
                    </form>
                </div>

                <div class="adProfil">
                    <div id="displayAdUp">
                        <div id="inProgess">
                            <h3>Enchères en cours</h3>
                            <?php foreach ($in_progress as $progress_list) { ?>
                                <div class="ad">
                                    <h4> Annonce <?php echo $progress_list['id'] ?></h4>
                                    <div class="contentAd">
                                        <p>Marque : <?php echo $progress_list['brand'] ?></p>
                                        <p>Modèle : <?php echo $progress_list['modele'] ?></p>
                                        <p>Prix : <?php echo $progress_list['price'] ?> €</p>
                                        <p>Date de fin des enchères : <?php echo $progress_list['end_date'] ?></p>
                                        <p class="linkAd"><a href="ad-page?id=<?php echo $progress_list['id'] ?>">Cliquez ici</a> pour plus d'informations</p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div id="finished">
                            <h3>Enchères remportées</h3>
                            <?php foreach ($finished as $finished_list) { ?>
                                <div class="ad">
                                    <h4> Annonce <?php echo $finished_list['id'] ?></h4>
                                    <div class="contentAd">
                                        <p>Marque : <?php echo $finished_list['brand'] ?></p>
                                        <p>Modèle : <?php echo $finished_list['modele'] ?></p>
                                        <p>Prix : <?php echo $finished_list['price'] ?> €</p>
                                        <p>Date de fin des enchères : <?php echo $finished_list['end_date'] ?></p>
                                        <p class="linkAd"><a href="ad-page?id=<?php echo $finished_list['id'] ?>">Cliquez ici</a> pour plus d'informations</p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <h3 id="titleAdCreated">Mes annonces créées</h3>
                    <div id="displayAdDown">
                        <div id="inProgessCreated">
                            <h3>Enchères en cours</h3>
                            <?php foreach ($in_progress_created as $progress_list_created) { ?>
                                <div class="ad">
                                    <h4> Annonce <?php echo $progress_list_created['id'] ?></h4>
                                    <div class="contentAd">
                                        <p>Marque : <?php echo $progress_list_created['brand'] ?></p>
                                        <p>Modèle : <?php echo $progress_list_created['modele'] ?></p>
                                        <p>Prix : <?php echo $progress_list_created['price'] ?> €</p>
                                        <p>Date de fin des enchères : <?php echo $progress_list_created['end_date'] ?></p>
                                        <p class="linkAd"><a href="ad-page?id=<?php echo $progress_list_created['id'] ?>">Cliquez ici</a> pour plus d'informations</p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div id="finishedCreated">
                            <h3>Enchères finies</h3>
                            <?php foreach ($finished_created as $finished_list_created) { ?>
                                <div class="ad">
                                    <h4> Annonce <?php echo $finished_list_created['id'] ?></h4>
                                    <div class="contentAd">
                                        <p>Marque : <?php echo $finished_list_created['brand'] ?></p>
                                        <p>Modèle : <?php echo $finished_list_created['modele'] ?></p>
                                        <p>Prix : <?php echo $finished_list_created['price'] ?> €</p>
                                        <p>Date de fin des enchères : <?php echo $finished_list_created['end_date'] ?></p>
                                        <p class="linkAd"><a href="ad-page?id=<?php echo $finished_list_created['id'] ?>">Cliquez ici</a> pour plus d'informations</p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                &copy;Auto-enchère - OS
            </footer>
            <!--Script app-->
            <script type="text/javascript" src="assets/styles/app-profil.js?ts=<?= time() ?>"></script>
        </body>

        </html>
<?php }
}
