<?php
include('menu.php');
include('lib/php/fonctions.php');

//connection à la BD
$connection = ConnectionBD();
ob_start();
?>
<!--<div style="overflow-x:auto;"> -->

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
        $msg .= 'Vous vous êtes <b> désinscrits </b>!'; ?>

        <script>
            $.alert({
                title: 'Alert!',
                content: 'Compte supprimé!',
            });
        </script>
<?php
        header('refresh:3;url=index.php');
        session_destroy();
        unset($_SESSION);
    }
}

echo $msg;
?>

<div id='footer1' style='margin-top:20%' <?php include("footer.php"); ?> <?php

                                                                            //destruction de la connection à la base de données
                                                                            unset($connection);

                                                                            ob_end_flush();

                                                                            ?>