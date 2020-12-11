<head>
  <link rel="stylesheet" href="./css/style2.css">

</head>
<?php require_once('menu.php'); ?>
<div class="production_video_page_container" style="height: auto; padding-top:15px;">
<?php
  // inclure le menu 
include('lib/php/fonctions.php');  // inclure la page de la connexion à la base de données 
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);
$connection = ConnectionBD(); // rappel à la fonction pour se connecter à la base de données
?>

<div style=" width: 80%; ">

  <div class="container" style=" width: 80%; height:auto; background-color: rgba(177, 178, 179, 0.562);">
    <?php if (isset($_GET['id'])) {
      extract($_GET);
      // echo $_GET;
      $sql = $connection->prepare("SELECT * FROM video WHERE videoID='$id' ");

      $sql->execute();
      $s = $sql->fetch();
      //echo ' id est : '.$s->id; echo ' ';
      extract($s);
    ?>
      <p style=" position:relative"><button type="button" class="btn " style="background-color: red; color:white; border: black 1px solid">
      
          <a href="Video.php">
            
            < Retour aux vidéos</a> </button> </p> <div class="card mb-1" style=" width: 100%; min-width: 250px; background-color: rgba(177, 178, 179, 0.562); box-shadow: 0px 5px 8px 5px #0f0e0e85; padding: 15px">
            <div style="position: absolute; padding-top: 140px; padding-left: 50%"> <?php include('ranking.php'); ?> </div>

              <div class="card-body">
                <h1 class="card-title"><?php echo $titre; ?></h1>
                <p class="card-subtitle text-muted">Durée: <?= $duree; ?> minutes</p>
                <p class="card-title">Langue: <?php echo $langue; ?><p>
                    <p class="card-title">Subtitre: <?php echo $subtitle; ?><p>
              </div>



              <!--<p class="list-group list-group-flush" class="list-group-item"><?= $genre; ?>
        </p>-->
              <?php
              echo "<video src='" . $chemin_video . "' controls width='auto' height='auto'  bgcolor='black' allowfullscreen='true' allowscriptaccess='always'  >";
              ?>


<?php 
    }

?>

</div>

</div>
</div>
</div>



<?php

//destruction de la connection à la base de données
unset($connection);
?>
<?php include('footer.php'); ?>

