<?php include('menu.php'); ?>
<link rel="stylesheet" href="./css/style2.css">





<?php
ob_start();
?>





    <div class="profile_page_container" style=" height:auto; min-height: 100%;">
    <?php
    include('lib/php/fonctions.php');
    $connection = ConnectionBD();
    if (!isset($_SESSION['login'])) {
        //rédirection vers la page d'accueil
        header('refresh:2;url=inscription.php');
        exit();
    }

    //$defaut_genre = 'F';
    // $defaut_pays = 'BE'; 



    // Une selection afin d'afficher les données dans les champs formulaire c'est qui permet à l'utilisateur de choisir les données à modifier (un ou plusiers)

    $login = $_SESSION['login'];
    $select = $connection->query("SELECT * FROM utilisateur  WHERE userID='$login' ");
    $s = $select->fetch(PDO::FETCH_BOTH);
    extract($s); ?>


    <div class="profile_container" style=" height: 100%;">
        <hr />

        <div class="section1">
            <h1>Profile</h1><br>
            <!-- delet account starts here  -->
            <?php
            $select = $connection->prepare("SELECT * FROM utilisateur WHERE userID='$userID' AND role='membre'"); // on select tout le produits  
            $select->execute();

            while ($s = $select->fetch(PDO::FETCH_OBJ)) {
            ?>
                <!-- Affichage des produits avec des liens pour récupérer les ids de la category dans le url  vers la page category. -->
                <!--Lien Voir les produits  -->
                <a class="btn" href="deletmembre.php?action=delete&userID=<?= $s->userID ?>&Nom<?= $s->Nom ?>">Supprimer mon compte</a><br>

            <?php
            }
            ?>
            <!-- delet account ends here  -->
            <h5><?= $_SESSION['login']; //. ' genre : '.$uti_genre 
                ?></h5>

        </div>
        <hr />
        <div class="section2">

            <form class="" action="profile.php" method="post" id="registrationForm">
                <label for="prenom">
                    <h4>Prénom</h4>
                </label>

                <input name="prenom" placeholder="" title="Maximum 30 caractéres" type="text" value="<?php echo $prenom; ?>" maxlength="30" style="width: 100%; height: 50px; margin-bottom: 10px">

                <!-- NOM: champ texte -->
                <h4>Nom</h4>
                </label>

                <input name="nom" placeholder="" title="Maximum 30 caractéres" type="text" value="<?php echo $Nom; ?>" maxlength="30" style="width: 100%; height: 50px; margin-bottom: 10px">

                <label for="adresse">
                    <h4>Adresse</h4>
                </label>

                <input name="adresse" placeholder="adresse" value="<?php echo $adresse; ?>" title="Maximum 20 caractéres" type="text" value="" maxlength="50" style="width: 100%; height: 50px; margin-bottom: 10px">
                <label for="mdp">
                    <h4>Ancien mot de passe</h4>
                </label>
                <input name="oldmdp" placeholder="ancienmotdepasse" title="Maximum 20 caractéres" type="password" value="" maxlength="12" style="width: 100%; height: 50px; margin-bottom: 10px">

                <h4>Nouveau mot de passe</h4>
                </label>

                <input name="newmdp1" placeholder="nouveaumotdepasse" title="Maximum 20 caractéres" type="password" value="" maxlength="12" style="width: 100%; height: 50px; margin-bottom: 10px">
                <label for="mdp">
                    <h4>Confirmation</h4>
                </label>
                <input name="newmdp2" placeholder="confirmationmotdepasse" title="Maximum 20 caractéres" type="password" value="" maxlength="12" style="width: 100%; height: 50px; margin-bottom: 10px">
                <button class="btn" type="submit" name="btnModification" style="background-color: red; color: white; border-radius: 5px; padding: 5px; border: 1px white solid; margin: 5px"> Modifier </button>
            </form>
        </div>
    </div>
    </div>
        <?php include('footer.php'); ?> 


        <!-- delet account Try starts here  -->

        <!-- /tab-content -->

        <?php


        if (isset($_POST['btnModification'])) {

            //on récupere l'id de l'utilisateur connecté
            $login = $_SESSION['login'];

            //on récupere les données du formulaire
            extract($_POST);
            // vérification si touts les champs sont remplis

            if (empty($nom) || empty($prenom) || empty($adresse)) {
                $msg = "Veuillez remplir tous les champs";
                
            } else {
                // varfication si le nombre de caractère son plus de tois et moin de trente 
                if (strlen($nom) < 3  || strlen($nom) > 30) {
                    $msg = "Le nom doit comporter entre 3 et 30 caractères";
                } else if (strlen($prenom) < 3  || strlen($prenom) > 30) {
                    $msg = "Le prénom doit comporter entre 3 et 30 caractères";
                } else if (strlen($adresse) < 3  || strlen($adresse) > 30) {
                    $msg = "L'adresse doit comporter entre 3 et 30 caractères";
                } else { // On modifie le données 
                    //require('lib/php/function_picture.php');
                    $sql = $connection->query("UPDATE utilisateur SET  Nom='$nom', prenom='$prenom', adresse='$adresse'
            WHERE  userID='$login' LIMIT 1");
                }
                
                // traitement pour le mot de passe. véification si on a bien entrée une autre variable qui remplace dans le formulaire  
                if (!empty($oldmdp)) {
                    // On remplace l'ancien mot de passe par un autre 
                    $select = $connection->query("SELECT * FROM utilisateur WHERE userID='$login'");
                    //var_dump($select);
                    $s = $select->fetch(PDO::FETCH_BOTH);
                    if ($oldmdp == $s['mot_de_passe']) {
                        if ($newmdp1 != $newmdp2) { // vérification si les deux mots de passe sont identiques
                            $msg = '<div id ="h2" style="height: 100px; color: black;">Les mots de passe ne correspondent pas </h2>';
                        } else {
                            $sql = $connection->query("UPDATE utilisateur SET mot_de_passe='$newmdp2' WHERE userID='$login' LIMIT 1");
                        }
                    }
                }
                if ($sql == true) {
                    $msg = '<div id ="h2" style="height: 100px; color: black;">Les données ont bien été modifiées </br>Veuillez refrechir la page pour voir le changement!</h2>';
                } else {
                    $sql = false;
                    $msg = '<div id ="h2" style="height: 100px; color: black;">Modification impossible, veuillez contacter l\'administrateur </h2>';
                }
                
                
            }
        }
        //-------------------------------------------------------------------------------
        //--- ACCES NON AUTORISE
        //------------------------------------------------------------------------------- 
        else {
            //rédirection vers la page d'accueil si accés non autorisé
            //header('refresh:0;url=index.php');
            exit();
        }


        ?>



        <div style="height:auto; font-size:18px; width:99%; margin-top:1px; text-align:center; border: 1px solid #ff9800;;
        background: rgba(175, 128, 0, 0.603); 
         padding: 30px;">

            <?php

            echo $msg;

            ?>

        </div>



<?php
ob_end_flush();
//destruction de la connection à la base de données
unset($connection);
?>

</div>




