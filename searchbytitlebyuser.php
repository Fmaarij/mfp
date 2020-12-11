<?php
include('menu.php');
include('lib/php/fonctions.php');

//connection à la BD
$connection = ConnectionBD();
?>

<head>
    <link rel="stylesheet" href="./css/style2.css">
</head>

<div class="search_by_title">



    <?php
    $msg = "";
    /********** Gestion de barre de recherche produits ***********************/

    // vérification si le champs de recherche dans la barre de rechercher produit est vide   Remarque (la formulair est dans le nav menu) 
    // Remarque la critère de recherche produit et le titre du produit car on ne peut pas changer le category dans la table de category, mais on peut changer le FK qui correspond dans la table du produits

    if (isset($_POST['chercher'])) {
        $q = $_POST['q'];
        if (empty($q)) {
            $msg .= '<b>Veuillez remplir le champ de recherche </b>!<br>';
            // header('location:editVideo.php');
        } else
        // L'affichage de produits dans un tableau avant de les modifier ou les supprimer  afin de choisir le produit qui correspond 
        {
            $sql = $connection->query("SELECT * FROM video WHERE UPPER (titre) LIKE UPPER ('%$q%') OR LOWER (titre) LIKE LOWER('%$q%') ORDER BY videoID");
            $count = $sql->rowCount();
            if ($count > 0) {
                while ($s =  $sql->fetch(PDO::FETCH_OBJ)) {
    ?>
                    <div class="row" style=" display:block; ">
                        <div style='width:100%;margin-left:1%;float:left; text-align:center; display:block; width: 100%;  background-color: rgba(177, 178, 179, 0.562)' class="card mb-1 ">

                            <a style="text-decoration: none" href='product-video.php?titre=<?php echo $s->titre ?>&id=<?= $s->videoID ?>'>
                                <h5 style="margin-top: 20px; color: black" class="card-title"><?php echo $s->titre; ?></h5>
                                <video style="height: 200px; margin-left:-1%; width: 100%;" src="<?php echo $s->chemin_video; ?>" alt="video" />
                            </a>
                            <h6 class=""></h6>
                            <ul class="list-group list-group-flush" style="border-top:none; border-bottom: none; text-decoration: none;" style=" width: 80%;  background-color: rgba(177, 178, 179, 0.562)">
                                <p class="list-group-item"> Durée: <?php echo $s->duree; ?> minutes</p>
                                <p class="list-group-item"> Langue: <?php echo $s->langue; ?></p>
                                <p class="list-group-item"> Subtitle: <?php echo $s->subtitle; ?></p>
                            </ul>
                            <a href='video.php'> <button type="button" class="btn btn-outline-primary ">Retour aux vidéo </button> </a>
                        </div>
                    </div>
                <?php
                }
            } else { ?>

                <h2 style="font-size: 40px; padding-left: 40%; padding-top: 350px"> Aucun Résultat </h2>
                <a href='video.php' style="padding-left: 45%; padding-top: 50px"> <button type="button" class="btn  ">Retour aux vidéo </button> </a>

    <?php
            }
        }
    }
    ?>
</div>


<?php include("footer.php"); ?>