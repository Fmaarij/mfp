<head>
    <link rel="stylesheet" href="./css/style2.css">

</head>
<?php require('menu.php');  ?>


<?php
include('lib/php/fonctions.php');
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);
$connection = ConnectionBD();
$msg = '';
$msg2 = '';
if (isset($_POST['genre'])) {
    $genre = $_POST['genre'];
    if ($genre) {

        $select = $connection->prepare("SELECT genreID FROM genre where genre='$genre'");
        $select->execute();
        $count = $select->rowCount();
        if ($count > 0) {
            echo 'genre existe';
        } else {


            // Définir les varibles 
            $insert = $connection->query("INSERT INTO genre VALUES('','$genre')");
            //ON AFFICHE UN MESSAGE  
            if ($insert == true) {
                $msg .= 'Genre a été ajouté : ' . $genre;
                '<br>';
            } else {
                $msg .= 'erreur';
            }
        }
    }
} else {
    $msg .= '<h4>Veuillez ajouter ou supprimer un genre!</h4>';
}

?>
<!-- Le formulaire pour ajouter de produits -->


<div class="genre_page_container" style="height: 100%;">
    <div class="container">
        <br />
        <?= $msg ?>

        <div class="card" style=" width: 50%; min-width: 250px; background-color: rgba(177, 178, 179, 0.562); box-shadow: 0px 5px 8px 5px #0f0e0e85; padding: 15px">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="text-align:center;">Gestion de la table genre</h3>
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <!-- La liste de categorie  Champ text   -->

                                <input name="genre" type="text" value="" placeholder="Ajouter un genre">


                            </div>

                            <button name="submit" type="submit" name="genre" class="btn" style="background-color: red; color:white; border: black 1px solid">
                                Ajouter
                            </button>

                        </form>
                    </div>

                </div>
            </div>



            <br />
            <?php

            if (isset($_GET['supprimer'])) {
                $genre = $_GET['genre'];
                $genreID = ['genreID'];

                $sql = $connection->query("DELETE FROM genre WHERE genreID='$genre'");
                if ($sql == true) {
                    echo 'Suppression effectuée pour ' . $genre;
                    //header('refresh:2;url=genre.php');
                }
            }

            ?>
            <form method="GET" action="">
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

                    <a href="genre.php?id= <?= $genreID ?> "><button type="submit" name="supprimer" class="btn" style="background-color: red; color:white; border: black 1px solid">
                            Supprimer le genre
                        </button></a>
                    

                </div>
            </form>
        </div>

        <!--<a href='deletgenre.php'> <button class="btn btn-lg btn-success  d-flex" >
                                 Supprimer le genre
            </button></a>-->
    </div>
</div>


<?php

include('footer.php'); ?>
<?php
//destruction de la connection à la base de données
unset($connection);
?>