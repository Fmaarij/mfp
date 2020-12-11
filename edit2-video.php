<?php


include('lib/php/fonctions.php');
//connection à la BD
$connection = ConnectionBD();
?>

<head>


    <title>Menu Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="./css/style2.css">


</head>
<?php
include('menu.php'); ?>
<?php

if ($_GET['action'] == 'modify') {
    extract($_GET);
    extract($_POST);
    $videoID = $_GET['videoID']; // On récupère l'id du produit

    if (isset($_POST['btnModification'])) {
        /* CHAMP IMAGE ******************************/
        $dossier = 'medias/video/video-produits/'; // CREATION DU DOSSIER pour mettre limage definitivement
        $fichier = basename($_FILES['video_produit']['name']); // On recupere le nom du fichier
        $taille_maxi = 5242880000; // Taille maximum de video
        $taille = filesize($_FILES['video_produit']['tmp_name']); // ON recupere la taille de limage
        $extensions = array(".mp4", ".avi", ".3gp", ".mov", ".mpeg", ".jpg"); // On créer un tableau pour limiter le format
        $extension = strrchr($_FILES['video_produit']['name'], '.');  // On recupere les caracteres après le point
        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Vous devez uploader un fichier de type png, gif,  JFIF, jpg, jpeg, txt ou doc...';
            //header("Location:addProduct.php?error=format_error");
        }
        if ($taille > $taille_maxi) {
            $erreur = 'Le fichier est trop gros...';
            header("Location:AddVideo.php?error=taille_error");
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

        /*FIN CHAMP IMAGE ***********/
        extract($_GET);
        extract($_POST);
        $chemin_final = $dossier . $fichier;
        // Recuperer la FK categoryID qui nous permet de modifier le categoryID du produits  
        $videoID = $_GET['videoID']; // id category (la table de category)
        //UPDATE LES DONNEES 
        $sql = $connection->prepare("UPDATE video SET titre= '$titre', duree='$duree', genre='$genre', langue='$langue', chemin_video ='$chemin_final' WHERE videoID='$videoID'");
        $sql->execute();
        $count = $sql->rowCount();
        //ON AFFICHE UN MESSAGE  
        if ($count > 0) {
            echo 'video modifié ';
?>
            <script>
                $.alert({
                    title: 'Alert!',
                    content: 'Produit supprimé!',
                });
                alert('ok');
            </script>
    <?php

            header('refresh:2;url=editVideo.php');
        } else {
            echo 'erreur';
        }
    }
}

/****FIN DE L'UPDATE*/
// Requête sql permet récupérer les produits afin d'en afficher la valeur dans la formulaire et ce n'est pas une boucle sinon la formulaire sera bouclé donc je peux afficher la valeur pour un seul produit ..
if (isset($_GET["videoID"])) {
    $videoID = $_GET["videoID"];

    $select = $connection->query("SELECT * FROM video WHERE videoID='$videoID'");
    $count = $select->rowCount();
    $s = $select->fetch(PDO::FETCH_BOTH);
    extract($s);
    //$video=$chemin_video;



    ?>
    <!-- DEBUT DE LA Formulaire de modification produits  -------------------->




    <div class="edit2_page_container" style="height: 100%;">
        <div class="container" style=" width: 70%; min-width: 250px; background-color: rgba(177, 178, 179, 0.562); box-shadow: 0px 5px 8px 5px #0f0e0e85; padding: 15px">

            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label for="titre" class="col-1 col-form-label">Titre</label>
                            <div class="col-8">
                                <input style="padding: 2px; color: darkred; min-width: 220px; border: black 1px solid; background-color:rgba(177, 178, 179, 0.7)" type="text" name="titre" placeholder="titre" value="<?php echo $titre; ?>" class="form-control here" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="duree" class="col-1 col-form-label">Duree</label>
                            <div class="col-8">
                                <input style="padding: 2px; color: darkred; min-width: 220px; border: black 1px solid; background-color:rgba(177, 178, 179, 0.7)" id="duree" name="duree" placeholder="duree" value="<?php echo $duree; ?>" class="form-control here" type="text" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="genre" class="col-1 col-form-label">Genre</label>


                            <select name="genre">Genre
                                <?php
                                $default_id;
                                $sql = 'SELECT genreID,genre FROM genre';
                                $resultat = $connection->query($sql);
                                foreach ($resultat as $element) {
                                    echo '<option style="color: darkred" value="' . $element['genreID'] . '"selected>' . $element['genre'] . '</option>';
                                }
                                ?>
                            </select>
                            <!--  <div class="col-8">
                            <input type="text"  name="genre"   value="<?php echo $genre; ?>"placeholder="genre"class="form-control here">
                                
                        </div>-->




                        </div>
                        <div class="form-group row">
                            <label for="video" class="col-1 col-form-label">Video: </label>
                            <div class="col-8">
                                <input style="padding: 2px; color: darkred; min-width: 220px; border: black 1px solid; background-color:rgba(177, 178, 179, 0.7)" type="file" id="video" name="video_produit" value="<?php echo $chemin_video; ?>" placeholder="video" class="form-control here" type="file" />

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="langue" class="col-1 col-form-label">Langue: </label>
                            <div class="col-8">
                                <input style="padding: 2px; color: darkred; min-width: 220px; border: black 1px solid; background-color:rgba(177, 178, 179, 0.7)" type="text" id="langue" name="langue" value=" <?php echo $langue ?>" placeholder="langue" class="form-control here" />

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="subtitle" class="col-1 col-form-label">Subtitle: </label>
                            <div class="col-8">
                                <input style="padding: 2px; color: darkred; min-width: 220px; border: black 1px solid; background-color:rgba(177, 178, 179, 0.7)" type="text" id="subtitle" name="subtitle" value=" <?php echo $subtitle ?>" placeholder="subtitle" class="form-control here" />

                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="btnModification" type="submit" class="btn" style="background-color: red; color:white; border: black 1px solid">
                                    Valider
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


<?php

} ?>
</div>
<?php

include('footer.php');
?>