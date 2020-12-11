<head>
    <link rel="stylesheet" href="./css/style2.css">

</head>
<div class="add_video_page_container" style="height: auto; min-height:100%">
    <?php
    //session_start();
    include('menu.php');
    include('lib/php/fonctions.php');
    error_reporting(E_ALL);
    ini_set("display_errors", E_ALL);
    $connection = ConnectionBD();
    //connection à la BD

    $msg = '';

    if (isset($_POST['submit'])) {
        $dossier = 'medias/video/video-produits/'; // CREATION DU DOSSIER pour mettre limage definitivement
        $fichier = basename($_FILES['video_produit']['name']); // On recupere le nom du fichier
        $taille_maxi = 5242880000; // 500MB;// // Taille maximum de video
        $taille = filesize($_FILES['video_produit']['tmp_name']); // ON recupere la taille de la video
        $extensions = array(".mp4", ".avi", ".3gp", ".mov", ".mpeg", ".jpg"); // On créer un tableau pour limiter le format
        $extension = strrchr($_FILES['video_produit']['name'], '.');  // On recupere les caracteres après le point
        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Vous devez uploader un fichier de type mp4, avi,  3gp, mov, mpeg, jpg...';
            //header("Location:addProduct.php?error=format_error");
        }
        if ($taille > $taille_maxi) {
            $erreur = 'Le fichier est trop gros...';
            //header("Location:AddVideo.php?error=taille_error");
        }
        if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            //On formate le nom du fichier ici...
            $fichier = strtr(
                $fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
            );
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            if (move_uploaded_file($_FILES['video_produit']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                $bool = true;
                $chemin_final = $dossier . $fichier;
            } else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
                header("Location:AddVideo.php?error=upload_error");
            }
        } else {
            echo $erreur;
        } // Définir les varibles 

        $titre = $_POST['titre'];
        $duree = $_POST['duree'];
        $genre = $_POST['genre'];
        $langue = $_POST['langue'];
        $subtitle = $_POST['subtitle'];
        $pays = $_POST['pays'];

        $chemin_final = $dossier . $fichier;
        if ($titre && $duree && $genre && $chemin_final) {
            $insert = $connection->prepare("INSERT INTO video VALUES('','$titre', '$duree','$genre','$langue', '$subtitle', '$pays','$chemin_final')");
            $insert->execute();
            //on exécute la commande sql d'inscription
            if ($insert == true) {
                $msg .= 'Video a été ajouté : ' . $titre;
                '<br>';
            } else {
                $msg .= 'erreur';
            }
        } else {
            $msg .= 'Veuiller remplir tous les champs';
        }
    }

    ?>
    <!-- Le formulaire pour ajouter de produits -->
    <div class="container" style="z-index: -2; margin-top: 100px">
        <br />
        <div class="card" style="background-color: rgba(177, 178, 179, 0.562); box-shadow: 0px 5px 8px 5px #0f0e0e85;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Ajouter une vidéo </h4>
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div id="h2>">
                            </div>
                            <div class="form-group row">
                                <!-- Le titre de produit Champ text   -->
                                <label for="titre" class="col-4 col-form-label">Titre</label>
                                <div class="col-8">
                                    <input id="titre" name="titre" placeholder="titre" class="form-control here" type="text" />

                                </div>
                            </div>
                            <!-- Le prix Champ double   -->
                            <div class="form-group row">
                                <label for="duree" class="col-4 col-form-label">Durée: </label>
                                <div class="col-8">
                                    <input id="duree" name="duree" placeholder="duree" class="form-control here" type="text" />

                                </div>
                            </div>

                            <div class="form-group">
                                <!-- La liste de categorie  Champ text   -->
                                <select name="genre">Genre:
                                    <?php
                                    $defaut_id = 1;
                                    $connection = ConnectionBD();
                                    //requête qui séléctionne la colonne "pay_fr" de la table "mabase.pays"
                                    $sql = 'SELECT * FROM genre';

                                    //exécution de la requête
                                    $resultats = $connection->query($sql);

                                    foreach ($resultats as $genre) {
                                        if ($genre['genreID'] == $defaut_id) {
                                            // Association le code à sa categorie

                                            echo '<option value="' . $genre['genreID'] . '" selected>' . $genre['genre'] . '</option>';
                                        } else {
                                            echo '<option value="' . $genre['genreID'] . '">' . $genre['genre'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Le Stock Champ nomber  -->





                            <!-- La description  Champ text   -->
                            <!--<div class="form-group row">
                                <label for="genre" class="col-4 col-form-label">Genre: </label>
                                <div class="col-8">
                                    <input type="text" id="genre" name="genre" placeholder="genre"
                                        class="form-control here">
                   
                                    
                            </div>
                            </div> -->
                            <!-- L'image du produit Champ varchar   -->
                            <div class="form-group row">
                                <label for="langue" class="col-4 col-form-label">Langue: </label>
                                <div class="col-8">
                                    <input type="text" id="langue" name="langue" placeholder="langue" class="form-control here" />

                                </div>
                            </div>
                            <!-- L'image du produit Champ varchar   -->
                            <div class="form-group row">
                                <label for="subtitle" class="col-4 col-form-label">Sous-titre: </label>
                                <div class="col-8">
                                    <input type="text" id="subtitle" name="subtitle" placeholder="subtitle" class="form-control here" />

                                </div>
                            </div>


                            <!-- PAYS: select basic -->
                            <div class="form-group">
                                <!--<label for="pays">Date de naissance: </label>-->
                                <select name="pays">Pays:
                                    <?php
                                    $defaut_pays = 'BE';
                                    $connection = ConnectionBD();
                                    //requête qui séléctionne la colonne "pay_fr" de la table "mabase.pays"
                                    $sql = 'SELECT pay_code, pay_fr FROM pays';

                                    //exécution de la requête
                                    $resultats = $connection->query($sql);
                                    var_dump($resultats);

                                    //boucle pour afficher tous les pays de la table "mabase.pays"								
                                    foreach ($resultats as $pays) {
                                        if ($pays['pay_code'] == $defaut_pays) {
                                            echo '<option value="' . $pays['pay_code'] . '" selected>' . $pays['pay_fr'] . '</option>';
                                        } else {
                                            echo '<option value="' . $pays['pay_code'] . '">' . $pays['pay_fr'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Le Stock Champ nomber  -->

                            <div class="form-group row">
                                <label for="video" class="col-4 col-form-label">Vidéo: </label>
                                <div class="col-8">
                                    <input type="file" id="video" name="video_produit" placeholder="video" class="form-control here" type="file" />

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn" style="background-color: red; color:white; border: black 1px solid">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="form1">
            <div id="h2>">
                <?php
                echo $msg;
                ?>
            </div>

        </div>

    </div>
</div>


<?php include('footer.php'); ?>