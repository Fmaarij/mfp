<?php include("menu.php"); ?>
<div style="height: auto; min-height: 100%; " >

<?php
include('lib/php/fonctions.php');
$connection = ConnectionBD();
if (isset($_GET['chercher'])) {
    extract($_GET);
    // $p=$_GET['p'];
    $msg = "";
?>

    <head>
        <link rel="stylesheet" href="./css/style2.css">
    </head>
<div class="container search_by_genre">


        <?php
        $genreID = $_GET['genre'];
        // $p=$_GET['p'];

        $sql = $connection->query("SELECT * FROM video WHERE genre='$genreID' ORDER BY titre");

        // $sql = $connection->query("SELECT * FROM video WHERE UPPER (titre) LIKE UPPER ('%$p%') AND genre='$genreID' OR LOWER (titre) LIKE LOWER('%$p%') AND genre='$genreID' ORDER BY titre"); 

        $count = $sql->rowCount();
        if ($count > 0 || is_null($count)) {
            while ($s =  $sql->fetch(PDO::FETCH_OBJ)) {
        ?>

                    <div class="row">
                        <div  class="container" style="text-align:center;" >

                            <a href='product-video.php?titre=<?php echo $s->titre ?>&id=<?= $s->videoID ?>'>
                                <h5 class="card-title"><?php echo $s->titre; ?></h5>
                                <video style="height: 200px; margin-left:-1%; width: 100%;" src="<?php echo $s->chemin_video; ?>" alt="video" />
                            </a>
                            <h6 class="card-subtitle text-muted"></h6>
                            <ul class="list-group list-group-flush" style="text-decoration: none;">
                                <p class="" style="padding-top: 10px;"> Durée: <?php echo $s->duree; ?> minutes</p>
                                <p class=""> Langue: <?php echo $s->langue; ?></p>
                                <p class=""> Subtitle: <?php echo $s->subtitle; ?></p>
                            </ul>
                            <a href='video.php'> <button type="button" class="btn btn-outline-primary ">Retour aux vidéo </button> </a>
                        </div>
                    </div>
                <?php
            }
        } else { ?>
            <div

                <h2 style="font-size: 40px; padding-left: 4%; padding-top: 350px; width: 50px"> Aucun Résultat </h2>
                <a href='video.php' style="padding-left: 4%; padding-top: 50px"> <button type="button" class="btn  ">Retour aux vidéo </button> </a>
        </div>
        <?php


        }
    }
        ?>
    
    <?php
    unset($connection);
    ?>
    </div>
</div>
   
    <?php include('footer.php'); ?>