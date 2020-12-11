<?php
include('menu.php');
include('lib/php/fonctions.php');

//connection à la BD
$connection = ConnectionBD();
?>

<head>
    <link rel="stylesheet" href="./css/style2.css">


</head>
<div class="search_video_page_container">
    <div class="container">

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
                $sql_search = $connection->query("SELECT * FROM video WHERE UPPER (titre) LIKE UPPER ('%$q%') OR LOWER (titre) LIKE LOWER('%$q%') ORDER BY videoID");
                $count = $sql_search->rowCount();
                if ($count > 0) { ?>
                    <div class="container" style="margin-top:0%;">
                        <hr />
                        <h1 style="display: inline-block;">Veuillez modifier ou supprimer vos vidéos</h1>
                        <hr />

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- Select categoy qui coresspond à chaque produit et on l'affiche dans un tableau -->

                                    <th scope="col">VIDEO</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Duree</th>
                                    <th scope="col">langue</th>
                                    <th scope="col">Supprimer</th>
                                    <th scope="col">Modifier</th>
                                </tr>
                            </thead>
                            <!-- On boucle pour afficher -->
                            <?php while ($s = $sql_search->fetch(PDO::FETCH_BOTH)) {
                                extract($s);

                            ?>

                                <tbody>
                                    <tr>
                                        <td><video style="height: 100px; width: 60px; display: block; " src="<?= $s['chemin_video']; ?>" alt="video" /></td>
                                        <td><?= $s['videoID']; ?></td>
                                        <td><?= $s['titre']; ?></td>
                                        <td><?= $s['genre']; ?></td>
                                        <td><?= $s['duree']; ?></td>
                                        <td><?= $s['langue']; ?></td>


                                        <?php

                                        // ON RECUPERE LES DONNEES PAR LA METHODE GET POUR LES MODIFIER OU LES SUPPRIMER
                                        echo '<td >&nbsp;&nbsp;&nbsp;<a class="btn" title="Supprimer" href="search-video.php?action=delete&videoID=' . $s['videoID'] . '&titre=' . $s['titre'] . '">Supprimer</a></td>
        <td><a class="btn" title="Modifier la video " href="edit2-video.php?action=modify&videoID=' . $s['videoID'] . '&titre=' . $s['titre'] . '">Modifier</a></td>
        ';
                                        ?>
                                    </tr>
                                </tbody>
                            <?php
                            }
                            ?>
                        </table>

            <?php
                } else {
                    echo 'Aucun résultat pour: <?= $q ?>...';
                }
            }
        }
            ?>
            <button type="button" class="btn ">
                <a href="editVideo.php">Retour aux vidéos</a></button> <?php

                                                                        $msg = '';
                                                                        if (isset($_GET['action'])) {
                                                                            extract($_GET);
                                                                            extract($_POST);

                                                                            /**** DEBUT ACTION SUPPRIMER LE PRODUITS ***********/
                                                                            if ($_GET['action'] == 'delete') {
                                                                                $id = $_GET['videoID'];
                                                                                // Supprimer un produi
                                                                                $sql = $connection->query("DELETE FROM video WHERE videoID='$id'");
                                                                                $msg .= '  Vidéo a été <rouge><b>supprimé</b></rouge>!';    ?>
                    <script>
                        $.alert({
                            title: 'Alert!',
                            content: 'Vidéo supprimé!',
                        });
                    </script>
            <?php
                                                                                header('refresh:2;url=editVideo.php');
                                                                            }
                                                                        }

                                                                        echo $msg;
            ?>
                    </div>
    </div>
</div>
<?php include("footer.php")
?>