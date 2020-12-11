<?php
include('menu.php'); ?>

<?php


include('lib/php/fonctions.php');
//connection à la BD
$connection = ConnectionBD();
?>

<head>
    <link rel="stylesheet" href="./css/style2.css">


    <title>Menu Admin</title>
</head>
<div class="container" style="height: 100%; margin-top: 120px">

<?php

if ($_GET['action'] == 'modify') {
    extract($_GET);
    extract($_POST);
    $userID = $_GET['userID']; // On récupère l'id du produit

    if (isset($_POST['btnModification'])) {


        /*FIN CHAMP IMAGE ***********/
        extract($_GET);
        extract($_POST);

        // Recuperer la FK categoryID qui nous permet de modifier le categoryID du produits  
        $videoID = $_GET['userID']; // id category (la table de category)
        //UPDATE LES DONNEES 
        $sql = $connection->prepare("UPDATE utilisateur SET role ='$role' WHERE userID='$userID'");
        $sql->execute();
        $count = $sql->rowCount();
        //ON AFFICHE UN MESSAGE  
        if ($count > 0) {
            ?>
           <h2 style="margin-top: 120px; padding: 10px; color:black; color: rgb(59, 2, 2);">Membre modifié </h2>
           <?php
?>
            <script>
                $.alert({
                    title: 'Alert!',
                    content: 'membre modifier!',
                });
                alert('ok');
            </script>
    <?php

            header('refresh:2;url=Definir-role.php');
        } else {
            echo 'erreur';
        }
    }
}

/****FIN DE L'UPDATE*/
// Requête sql permet récupérer les produits afin d'en afficher la valeur dans la formulaire et ce n'est pas une boucle sinon la formulaire sera bouclé donc je peux afficher la valeur pour un seul produit ..
if (isset($_GET["userID"])) {
    $userID = $_GET["userID"];


    $select = $connection->query("SELECT * FROM utilisateur WHERE userID='$userID'");
    $count = $select->rowCount();
    $s = $select->fetch(PDO::FETCH_BOTH);
    extract($s);
    //$video=$chemin_video;



    ?>


        <div class="form">

        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="" enctype="multipart/form-data">

                <label for="video" style="font-size: 20px; padding: 5px;">Veuillez Modifier le role de :<?php echo " " . $Nom . " " . $prenom ?> <br> Vous avez 2 choix : 1:admin 2:membre </label>

                    <div class="form-group row">
                        <div class="col-8">
                            <input type="text" id="role" name="role" value="<?php echo $role; ?>" placeholder="role" class="form-control here" />
                            <div style="display: flex; justify-content:center; align-items:center; padding: 5px; min-height:100px">
                                <button name="btnModification" type="submit" class="btn"><a>
                                        Valider </a>
                                </button>
                                <button type="button" class="btn">
                                    <a href="Definir-role.php">Retour a la page role</a>
                                </button>
                            </div>
                        </div>

                    </div>


                </form>

            </div>
        </div>

    <?php
}
    ?>
    </div>
    <?php include('footer.php');
    ?>