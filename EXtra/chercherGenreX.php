<?php
include('lib/php/fonctions.php');
$connection = ConnectionBD();
if (isset($_GET['chercher'])){
  extract($_GET);
    $p=$_GET['p'];
    $msg="";
    ?>
<html>
       <?php  require_once("menu.php"); ?>
    <div class="container">
      <?php  
   $genreID=$_GET['genre'];
    $p=$_GET['p'];
   
  $sql = $connection->query("SELECT * FROM video WHERE UPPER (titre) LIKE UPPER ('%$p%') AND genre='$genreID' OR LOWER (titre) LIKE LOWER('%$p%') AND genre='$genreID' ORDER BY titre"); 
   
    $count= $sql->rowCount();
    if($count>0) 
    { while($s =  $sql->fetch(PDO::FETCH_OBJ)){
?>
<div class ="row">
    <div >
        
        <a href='product-video.php?titre=<?php echo $s->titre ?>&id=<?= $s->videoID ?>'> 
            <h5 class="card-title"><?php echo $s->titre; ?></h5>
                <video style="height: 200px; margin-left:-1%; width: 100%;"
                       src="<?php echo $s->chemin_video; ?>"alt="video" /></a>
                     <h6 class="card-subtitle text-muted"></h6>
                <ul class="list-group list-group-flush" style ="text-decoration: none;">
                    <p class="list-group-item"> Durée: <?php echo $s->duree; ?> minutes</p>
                     <p class="list-group-item"> Langue: <?php echo $s->langue; ?></p>
                    <p class="list-group-item"> Subtitle: <?php echo $s->subtitle; ?></p>
            </ul>
         <a href='index.php'> <button  type="button" class="btn">Retour aux vidéo </button> </a>            
     </div>
    </div>
        <?php 
            }
        }else {
        echo 'aucun résultat ';
        }
    }
        ?>
        </div>
        <?php
        include ('footer.php'); ?>
    </body>
</html>
<?php
unset($connection);
?>
