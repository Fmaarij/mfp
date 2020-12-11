<head>
    <link rel="stylesheet" href="./css/style2.css">

</head>
<?php include('menu.php'); ?>
<div class="gallary_page_conainer" style="height: auto; min-height: 100%;  background-color: rgb(196, 149, 21);">

<?php
//session_start();

include('lib/php/fonctions.php');
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);
$connection = ConnectionBD();
//connection à la BD

$msg = '';

if (isset($_POST['submit'])) {
    $dossier = 'medias/video/photo-produits/'; // CREATION DU DOSSIER pour mettre limage definitivement
    $fichier = basename($_FILES['photo_produit']['name']); // On recupere le nom du fichier
    $taille_maxi = 5242880000; // 500MB;// // Taille maximum de video
    $taille = filesize($_FILES['photo_produit']['tmp_name']); // ON recupere la taille de la video
    $extensions = array(".png", ".jif", ".jpeg", ".jpg"); // On créer un tableau pour limiter le format
    $extension = strrchr($_FILES['photo_produit']['name'], '.');  // On recupere les caracteres après le point
    //Début des vérifications de sécurité...
    if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = 'Vous devez uploader un fichier de type png,jif,jpeg,jpg...';
        //header("Location:addProduct.php?error=format_error");
    }
    if ($taille > $taille_maxi) {
        $erreur = 'Le fichier est trop gros...';
        //header("Location:AddVideo.php?error=taille_error");
    }
    if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
        //On formate le nom du fichier ici...
        $fichier = strtr(
            $fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
        );
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        if (move_uploaded_file($_FILES['photo_produit']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            $bool = true;
            $chemin_final = $dossier . $fichier;
        } else //Sinon (la fonction renvoie FALSE).
        {
            echo 'Echec de l\'upload !';
            header("Location:index.php?error=upload_error");
        }
    } else {
        echo $erreur;
    } // Définir les varibles 

    //$titre=$_POST['Nom_photo'];

    $chemin_final = $dossier . $fichier;
    if ($chemin_final) {

        $insert = $connection->prepare("INSERT INTO gallery VALUES('','$chemin_final')");

        //  $insert =$connection->prepare("INSERT INTO gallery VALUES('',$chemin_final')");
        var_dump('$insert');
        $insert->execute();
        //on exécute la commande sql d'inscription
        if ($insert == true) {
            $msg .= 'Photo a été ajouté : ' . $chemin_final;
            '<br>';
        } else {
            $msg .= 'erreur';
        }
    } else {
        $msg .= 'Veuiller selectioner vos images';
    }
}

?>
<!-- Le formulaire pour ajouter de produits -->

<div class="gallary_page_container container">

    <div class="container" style=" width: 70%; min-width: 250px; background-color: rgba(177, 178, 179, 0.562); box-shadow: 0px 5px 8px 5px #0f0e0e85; padding: 15px">
        <br />
        <div class="card" style="background-color: rgba(177, 178, 179, 0.1)">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Ajouter le photo </h4>
                        <hr />
                    </div>
                </div>
                <div class="row" style=" width: 70%; min-width: 250px; background-color: rgba(177, 178, 179, 0.3); box-shadow: 0px 5px 8px 5px #0f0e0e85; padding: 15px">
                    <div class="col-md-12">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div id="h2>">
                            </div>

                            <!-- Le Stock Champ nomber  -->

                            <div class="form-group row">
                                <div class="col-8">
                                    <input style="padding: 2px; color: darkred; min-width: 220px; border: black 1px solid; background-color:rgba(177, 178, 179, 0.7)" type="file" id="video" name="photo_produit" placeholder="video" class="form-control here" type="file" />

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn" style="background-color: red; color:white; border: black 1px solid">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="form1">
            <div id="h2>">
                <?php
                echo $msg;
                ?>
            </div>

        </div>
    </div>
</div>
</div>

<?php include('footer.php'); ?>
