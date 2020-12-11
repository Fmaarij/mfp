<?php
include('menu.php');
include('lib/php/fonctions.php');

//connection à la BD
$connection = ConnectionBD();
?>

<head>
    <link rel="stylesheet" href="./css/style2.css">


</head>
<div class="seach_utilisateur_page_container">
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
                $sql_search = $connection->query("SELECT * FROM utilisateur WHERE UPPER (Nom) LIKE UPPER ('%$q%') OR LOWER (Nom) LIKE LOWER('%$q%') ORDER BY userID");
                $count = $sql_search->rowCount();
                if ($count > 0) { ?>
                    <div class="container" style="margin-top:0%;">
                        <hr />
                        <h1 style="display: inline-block;">Veuillez modifier ou supprimer les membre</h1>
                        <hr />

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- Select categoy qui coresspond à chaque produit et on l'affiche dans un tableau -->

                                    <th scope="col">UserName</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Mot De Pass</th>
                                    <th scope="col">Role</th>
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

                                        <td><?= $s['userID']; ?></td>
                                        <td><?= $s['Nom']; ?></td>
                                        <td><?= $s['prenom']; ?></td>
                                        <td><?= $s['adresse']; ?></td>
                                        <td><?= $s['mot_de_passe']; ?></td>
                                        <td><?= $s['role']; ?></td>


                                        <?php

                                        // ON RECUPERE LES DONNEES PAR LA METHODE GET POUR LES MODIFIER OU LES SUPPRIMER
                                        echo '<td>&nbsp;&nbsp;&nbsp;<a title="Supprimer" href="search-utilisateur.php?action=delete&userID=' . $s['userID'] . '&Nom=' . $s['Nom'] . '">Supprimer</a></td>
        <td><a title="Modifier le video " href="Definir-role1.php?action=modify&userID=' . $s['userID'] . '&Nom=' . $s['Nom'] . '">Modifier</a></td>
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
            <button type="button" class="btn">
                <a href="Definir-role.php">Retour à la page des Role</a></button> <?php

                                                                                    $msg = '';
                                                                                    if (isset($_GET['action'])) {
                                                                                        extract($_GET);
                                                                                        extract($_POST);

                                                                                        /**** DEBUT ACTION SUPPRIMER LE PRODUITS ***********/
                                                                                        if ($_GET['action'] == 'delete') {
                                                                                            $id = $_GET['userID'];
                                                                                            // Supprimer un produi
                                                                                            $sql = $connection->query("DELETE FROM utilisateur WHERE userID='$userID'");
                                                                                            $msg .= '  Membre a été <rouge><b>supprimé</b></rouge>!';    ?>
                    <script>
                        $.alert({
                            title: 'Alert!',
                            content: 'membre supprimé!',
                        });
                    </script>
            <?php
                                                                                            header('refresh:2;url=Definir-role.php');
                                                                                        }
                                                                                    }

                                                                                    echo $msg;
            ?>
                    </div>
    </div>
</div>
<?php include("footer.php"); ?>