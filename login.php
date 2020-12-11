<?php
include("menu.php");
?>


<html>

<head>
    <link rel="stylesheet" href="./css/style2.css">
</head>

<div class="sign_in_form">
    <!-- zone de connexion -->

    <form id="form" action="verification.php" method="POST">
        <h1 style="text-align:center; padding: 10px">Connexion<h1>
                <h3><a href="inscription.php">Si vous n'etes pas encore membre<br> cliquez ici pour vous inscrire.</a>
            </h3>

            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required style="width: 100%; height: 50px; margin-bottom: 10px">

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required style="width: 100%; height: 50px; margin-bottom: 10px">

            <input type="submit" name="btnConnection" id='submit' value='LOGIN' style="width: 100%; height: 50px; margin-bottom: 10px">
            <?php
            if (isset($_GET['erreur'])) {
                $err = $_GET['erreur'];
                if ($err == 1 || $err == 2)
                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
            }
            ?>
        </h1>
        </h1>
    </form>

</div>

<?php
include("footer.php");
?>