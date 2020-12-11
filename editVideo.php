<?php
include('menu.php');
include('lib/php/fonctions.php');

//connection à la BD
$connection = ConnectionBD();
ob_start();
?>

<head>
    <link rel="stylesheet" href="./css/style2.css">

</head>
<!--<div style="overflow-x:auto;"> -->
<div class="edit_video_page_container" style="height: auto; min-height: 100%">

    <div class="container">
        <form method="post" action="search-video.php" style="margin-left: 12%">
            <label for="search"></label>
            <input type="search" style="width:250px;" id="search" name="q" placeholder="Veuillez inserez le titre de la video..." />
            <input class="btn" type="submit" value="Valider" name="chercher" />
        </form>
    </div>



    <div class="row" style=" width: 70%; min-width: 250px; background-color: rgba(177, 178, 179, 0.562); box-shadow: 0px 5px 8px 5px #0f0e0e85; padding: 15px">

        <?php

        $select = $connection->prepare("SELECT * FROM video"); // on select tout le produits  
        $select->execute();

        while ($s = $select->fetch(PDO::FETCH_OBJ)) {

        ?>
            <!-- Affichage des produits avec des liens pour récupérer les ids de la category dans le url  vers la page category. -->
            <div class="card mb-1">


                <div class="card-body" style="background-color: rgb(196, 149, 21, 0.8)">

                    <div class="card-header" style="border-bottom: none; background-color:rgba(177, 178, 179, 0.0)">
                        <!-- Lien à partir de l'image et l'inscrpription car les longues descriptions sont coupées -->
                        <a style="text-decoration: none;" href='product-video.php?titre=<?php echo $s->titre ?>&id=<?= $s->videoID ?>'>
                            <h5 class="card-title" style="text-align: center; text-decoration:none; color:white"><?php echo $s->titre; ?></h5>
                            <video style="height: 200px; width: 100%; display: block; " src="<?php echo $s->chemin_video; ?>" alt="video" />
                            <h6 class="card-subtitle text-muted"><?php //echo $s->genre; 
                                                                    ?> </h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $s->duree; ?></li>
                            </ul>
                        </a>
                    </div>
                    <div class="card-body">
                        <!--Lien Voir les produits  -->
                        <a style="text-decoration: none;" href='product-video.php?titre=<?php echo $s->titre ?>&id=<?= $s->videoID ?>'>
                        </a>
                        <div style="display: flex; align-items:center; justify-content:center">
                            <a class="btn" href="editVideo.php?action=delete&videoID=<?= $s->videoID ?> &titre<?= $s->titre ?>">Supprimer</a><br>
                            <a class="btn" href="edit2-video.php?action=modify&videoID=<?= $s->videoID ?> &titre<?= $s->titre ?>">Modifier le video </a>
                        </div>

                    </div>
                </div>
            </div>

            <?php
        }
        $msg = '';
        if (isset($_GET['action'])) {
            extract($_GET);
            extract($_POST);

            /**** DEBUT ACTION SUPPRIMER LE PRODUITS ***********/
            if ($_GET['action'] == 'delete') {
                $id = $_GET['videoID'];
                // Supprimer un produi
                $sql = $connection->query("DELETE FROM video WHERE videoID='$id'");
                $msg .= '<h2 style="width 300px; height: 300px; position: absolute; background-color: red; color:white; margin-top: 300px; padding-left: 20%;">Vidéo a été <b> supprimé</h2></b>!'
                ;    ?>
                <script>
                    $.alert({
                        title: 'Alert!',
                        content: 'Vidéo supprimé!',
                    });
                </script>
        <?php
                header('refresh:5;url=editVideo.php');
            }
        }

        echo $msg;
        ?>

    </div>
</div>




<!--<div class="container" style=";display:flex; flex-dirction:column;">-->



<?php

//destruction de la connection à la base de données
unset($connection);

ob_end_flush();

?>

<?php include("footer.php")
?>