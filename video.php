<?php

//session_start();// demarrage de la session
require_once('menu.php'); //Inclure le fichier menu

include('lib/php/fonctions.php');    //inclure le fichier qui contient la connexion et la fonction à la base de données 
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);
$connection = ConnectionBD(); // On fait une appel à la fonction pour se connecter et effectuer des rêqutes sql
extract($_GET);
$login = $_SESSION['login'];
?>



<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="stylesheet" href="./css/video.css">

</head>


<div class="page_container">
    <div class="side_bar">

        <form method="get" action="chercherGenrecorrect.php" class="search_form">
            <div class='conteneur-search'>
                <select class='select-categorie' name="genre">

                    <?php

                    $sql = $connection->query("SELECT * FROM genre ");
                    while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
                        $genreID = $data->genreID;
                        $genre = $data->genre;
                    ?>
                        <option value="<?php echo $genreID; ?>"><?php echo  $genre; ?></option>
                    <?php
                    }
                    ?>
                </select>

                <label for="search"></label>
                <!-- <input type="search"  class="search" style="height:40px;" name="p" placeholder="Recherche le genre..." /> -->

                <div class="">
                    <input name="chercher" value="Confirmer" type="submit" class="btn">
                </div>
            </div>
        </form>

        <div>
            <form method="post" action="searchbytitlebyuser.php" class="valider_form">
                <label for="search"></label>
                <input type="search" id="search" name="q" placeholder="Veuillez inserez le titre de la video..." />
                <input type="submit" value="Valider" name="chercher" class="btn" />
            </form>
        </div>
    </div>


    <div class="video_container">
        <?php
        $select = $connection->prepare("SELECT * FROM video"); // on select tout le produits  
        $select->execute();
        while ($s = $select->fetch(PDO::FETCH_OBJ)) {
        ?>
            <!-- Affichage des produits avec des liens pour récupérer les ids de la category dans le url  vers la page category. -->
            <!-- Lien à partir de l'image et l'inscrpription car les longues descriptions sont coupées -->
            <div class="container">
                <div class="items" style="max-height: 100px;">
                    <a class="video_details1" href='product-video.php?titre=<?php echo $s->titre ?>&id=<?= $s->videoID ?>'>
                        <h6 class=""><?php echo $s->titre; ?></h6>
                        <video style="height: auto; width: 100% " src="<?php echo $s->chemin_video; ?>" alt="video" />
                        <h6 class=""><?php //echo $s->genre; 
                                        ?> </h6>
                        <ul class="">
                            <li class=""><?php echo $s->duree; ?></li>
                        </ul>
                    </a>


                    <!--Lien Voir les produits  -->
                   <!-- <a class="video_details2" href='product-video.php?titre=<?php echo $s->titre ?>&id=<?= $s->videoID ?>'>
                        <h6 style="font-size: 100%;">Regarder la vidéo</h6>
                    </a> -->
                </div>
                <!--<div class="container" style=";display:flex; flex-dirction:column;">-->
            </div>

        <?php
        }

        ?>

    </div>

</div>
<div>




    <?php
    //destruction de la connection à la base de données
    unset($connection);
    ?>
</div>
<?php include('footer.php'); ?>