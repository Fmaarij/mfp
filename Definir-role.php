<?php
include('menu.php');
include('lib/php/fonctions.php');

//connection à la BD
$connection = ConnectionBD();
ob_start();
?>
<!--<div style="overflow-x:auto;"> -->

<head>
    <link rel="stylesheet" href="./css/style2.css">

    <title>Menu Admin</title>

</head>
<div class="role_page_container" style="height: auto; min-height: 100%; margin-top: 30px">

    <div class="container" style="padding-left: 30%;">
        <form method="post" action="search-utilisateur.php">
            <label for="search"></label>
            <input type="search" style="width:250px;" id="search" name="q" placeholder="Veuillez inserez le nom de le membre..." />
            <input type="submit" value="Valider" name="chercher" class="btn" />
        </form>
    </div>



    <div class="row">

        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">USER ID</th>
                        <th scope="col">Role</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Supprimer</th>
                        <th scope="col">Modifier le roles</th>
                    </tr>
                </thead>


                <?php


                $select = $connection->prepare("SELECT * FROM utilisateur WHERE role='membre'"); // on select tout le produits  
                $select->execute();
                foreach ($select as $s) {
                    //while($s= $select->fetch(PDO:: FETCH_OBJ)){  

                ?>
                    <!-- Affichage des produits avec des liens pour récupérer les ids de la category dans le url  vers la page category. -->

                    <tbody>
                        <tr>
                            <td><?= $s['userID'] ?></td>
                            <td><?= $s['role'] ?></td>
                            <td><?= $s['Nom'] ?></td>
                            <td><?= $s['prenom'] ?></td>
                            <td> <a class="btn"  href="Definir-role.php?action=delete&userID=<?= $s['userID'] ?>&Nom<?= $s['Nom'] ?>">Supprimer</a></td>
                            <td> <a class="btn"  href="Definir-role1.php?action=modify&userID=<?= $s['userID'] ?> &Nom<?= $s['Nom'] ?>">Modifier le role </a></td><?php


                                                                                                                                                    } ?>
                        </tr>
                    </tbody>




                    <div class="card-body">
                        <!--Lien Voir les produits  -->
                    </div>
            </table>
        </div>

        <?php

        $msg = '';
        if (isset($_GET['action'])) {
            extract($_GET);
            extract($_POST);

            /**** DEBUT ACTION SUPPRIMER LE PRODUITS ***********/
            if ($_GET['action'] == 'delete') {
                $id = $_GET['userID'];
                // Supprimer un produi
                $sql = $connection->query("DELETE FROM utilisateur WHERE userID='$id'");
                $msg .= '<h3 style=" text-align: center; background:  rgb(150, 3, 3); height: 50px; width: 500px; margin-left: 5%; margin-top: 150px;  color: white; position:absolute; margin-top: -12px;">Le membre a été <b> supprimé!</h3></b>'; ?>

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

<!--<div class="container" style=";display:flex; flex-dirction:column;">-->


<?php

//destruction de la connection à la base de données
unset($connection);

ob_end_flush();

?>
 <?php include("footer.php"); ?> 
