<?php
include("menu.php");
include('lib/php/fonctions.php');
$connection = ConnectionBD();
ob_start();
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Kaushan+Script&family=M+PLUS+Rounded+1c:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style2.css">


    <title>Maarij Film Production</title>
</head>

<body>
    <main>
        <!-- Main Container -->


        <div class="banner_container">
            <?php


            $select = $connection->prepare("SELECT * FROM galLery LIMIT 1");
            $select->execute();
            foreach ($select as $s) {

            ?>
                <img id="banner_img" data-u="img" src="<?= $s['nom_photo'] ?>" /> <?php
                                                                                }

                                                                                    ?>
        </div>


        <!-- supprimer des photo de header -->
        <?php

        if (isset($_SESSION['login']))
            if ($_SESSION['role'] == 'admin') {
        ?>
            <div class="banner_btn_container">
                <button type="button" class="btn">
                    <a href="Gallery.php">Ajoutez une photo</a>
                </button>
                <button type="button" class="btn">
                    <a href="index.php?action=delete&id=<?= $s['GalleryID'] ?>">Supprimer la photo </a>
                </button>
            </div>
        <?php

            }

        ?>
        <?php


        $msg = '';
        if (isset($_GET['action'])) {
            extract($_GET);
            extract($_POST);

            if ($_GET['action'] == 'delete') {
                $id = $_GET['id'];

                $sql = $connection->query("DELETE FROM gallery WHERE GalleryID='$id'");
                $msg .= 'la photo a été <b> supprimé</b>!'; ?>
                <script>
                    $.alert({
                        title: 'Alert!',
                        content: 'Photo supprimé!',
                    });
                </script>
        <?php
                header('refresh:1;url=index.php');
            }
        }
        echo $msg;


        ?>

        <!-- About Section -->
        <h2 class="about_heading" style="text-align: center; margin-top:60px; color: rgb(150, 3, 3); font-family: 'Kaushan Script', cursive;">À-propos</h2>

        <section class="about_section" id="about">
            <div class="about_container">
                <div class="about_card">
                    <p class="tile"><strong>C’est quoi Maarij Film Production ?</strong><br>

                        Maarij Film Production c’est une boîte de production, qui se trouve à Bruxelles et qui produit des court-métrage, longue métrage, documentaire et etc… dans plusieurs langues comme Anglais, Français, Néerlandais, Hindi, Dari et Pashto.
                    </p>
                </div>
                <div class="about_card">
                    <p class="tile"><strong>Quand nous avons lancé cette boîte ?</strong><br>
                        Nous avons commencé avec un court métrage en Pashto le aout 2017 et c’était vraiment une réussite pour nous, ce pour cela que nous somme active jusqu’au maintenant.
                    </p>
                </div>
                <div class="about_card">
                    <p class="tile"><strong>Vous êtes impatiente de voir notre produit ?</strong><br>
                        Je vous invite de vous inscrire et voir les vidéos.
                    </p>
                </div>

            </div>

        </section>
        <!-- Stats Gallery Section -->


        <?php

        //destruction de la connection à la base de données
        unset($connection);

        ob_end_flush();

        ?>
        <!-- Main Container Ends -->
        <?php
        include("footer.php");
        ?>
    </main>
</body>

</html>