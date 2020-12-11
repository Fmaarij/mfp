<?php
include('lib/php/fonctions.php');	
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);
$connection = ConnectionBD();
$msg= '';
if(isset($_POST['supprimer'])){
    $genre=$_POST['genre'];
    $genreID=['genreID'];
    
$sql = $connection->query("DELETE FROM genre WHERE genreID='$genre'");
}
        ?>
        
   
    
        
        <!DOCTYPE html>
<html>
<body>
    <?php require('menu.php');  ?>
    <div class="container">
        <br/>
        <?= $msg ?>
        
       <form method="POST" action="deletgenre.php">
    <div class='conteneur-search'>
      <select class='select-categorie' name="genre">
                  
                 <?php
                
                    $sql =$connection->query ("SELECT * FROM genre ");	
					  while($data = $sql->fetch(PDO::FETCH_OBJ))
					  {
                          $genreID=$data->genreID;
                          $genre=$data->genre;
                    ?>
					<option value="<?php echo $genreID; ?>"><?php echo  $genre; ?></option>
					<?php    
					}
					?>             
              </select>
            <label for="search"></label>
                 <!-- <input type="search"  class="search" style="height:40px;" name="p" placeholder="Recherche le genre..." /> -->
                   
                     <div class="form-group row">
                            <div class="offset-4 col-8">
                            <input style="height:40px; margin-top:-0.30px;" name="supprimer" value="supprimer" type="submit" class="btn btn-primary">
                       </div>
                       </div>
                       </div>
        </form></div>
