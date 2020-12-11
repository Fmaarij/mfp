<head>
 <link rel="stylesheet" href="./css/style2.css">
 <title> Déconnexion </title>

</head>

<?php
include("menu.php");
?>
<div class="" style="background-color: #c49515; height:100%;">
<?php

$msg = "";
if (!isset($_SESSION['login'])) {
    header('refresh:0;url=inscription.php');
    exit();
} else {
    $msg = '<div id="h2"><h2>' . $_SESSION['login'] . ' vous êtes deconnecté</br> Au revoire! </h2>
        </div>';

    header('refresh:2;url=index.php');
    session_destroy();
    unset($_SESSION);
}
?>
<div class="content" style="height:400px; width:50%; margin-top:10%; text-align:center; margin-left:20%; border:1px solid #ff9800; padding:30px;">
    <?php
    echo $msg;
    ?>
</div>
</div>


<?php
unset($conection);
?>
<?php
include "footer.php";
?>