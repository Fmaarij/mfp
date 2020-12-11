<?php
include('lib/php/fonctions.php');
include("menu.php");
?>

<head>
	<title>BD: INSERT</title>
	<link rel="stylesheet" href="./css/style2.css">

</head>
<div class="container" style="height: auto; min-height: 100%; display:flex; justify-content:center">

<div class="sign_up_form" >

	<!-- Formulaire d'inscription -->
	<form id="form" name=" inscription" method="post" action="">
		<h1>Bienvenue à la page de l'inscription</h1>

		<label><b>Login </b></label>
		<input type="text" placeholder="Entrez un login" name="login" value="" style="width: 100%; height: 50px; margin-bottom: 10px" />

		<label><b>Nom </b></label>
		<input type="text" placeholder="Entrez votre nom" name="nom" value="" style="width: 100%; height: 50px; margin-bottom: 10px" />

		<label><b>Prénom </b></label>
		<input type="text" placeholder="Entrez votre prénom" name="prenom" value="" style="width: 100%; height: 50px; margin-bottom: 10px" />

		<label><b>Adresse </b></label>
		<input type="text" placeholder="Entrez votre adresse" name="adresse" value="" style="width: 100%; height: 50px; margin-bottom: 10px" />
		<!-- MOT DE PASSE: champ mot de passe -->
		<label><b>Mot de passe </b></label>
		<!--<label for="mdp1">Mot de passe </label>-->
		<input name="mdp1" placeholder="Mot de passe " type="password" required value="" style="width: 100%; height: 50px; margin-bottom: 10px">
		<div id='ERREURmdp1'></div>

		<label><b>Confirmation</b></label>

		<input name="mdp2" placeholder="Rétaper votre password" type="password" required value="" onkeyup="Verifier(this.value)" style="width: 100%; height: 50px; margin-bottom: 10px">
		<div id='ERREURmdp2'></div>
		<input type="submit" name="bouton" value="Inscription" style="width: 100%; height: 50px; margin-bottom: 10px" />

	</form>
</div>
<?php
//connection à la BD
$connection = ConnectionBD();

if (isset($_POST['bouton'])) {
	$login			= $_POST['login'];
	$nom			= $_POST['nom'];
	$prenom			= $_POST['prenom'];
	$adresse	    = $_POST['adresse'];
	$mdp1			= $_POST['mdp1'];
	$mdp2			= $_POST['mdp2'];
	//$avatar			= $_POST['avatar'];	


	//afin de pouvoir s'inscrire, on vérifie d'abord si le mot de passe et la confirmation sont bien égaux
	if ($mdp1 == $mdp2) {
		//cryptage du mot de passe
		//$mdp = md5( $_POST['mdp1'] );
		$mdp = ($_POST['mdp1']);

		/**************************************************************************************************************************
			 SYNTAXE GENERALE > INSERT INTO nom_table VALUES ( valeur colonne1, valeur colonne2,... )
		 **************************************************************************************************************************/
		/**************************************************************************************************************************
			 NORMAL > ETAPE 1   : préparation de la requête qui va insérer les données du formulaire dans la table utilisateurs
		 **************************************************************************************************************************/
		$sql = 'INSERT INTO utilisateur VALUES("' . $login . '","' . $nom . '","' . $prenom . '","' . $adresse . '", "' . $mdp . '", "membre")';
		$nbr = $connection->exec($sql);


		/*$sql = 'INSERT INTO utilisateur VALUES("'.$_POST['login'].'","'.$_POST['nom'].'","'.$_POST['prenom'].'","'.$_POST['adresse'].'","'.$_POST['mdp'].'")';*/
		/**************************************************************************************************************************
			 NORMAL > ETAPE 2   : éxecution la requête qu'on a préparé
		 **************************************************************************************************************************/
		if ($nbr > 0) {
			$msg = '<div id ="h2"><h3> Vous êtes inscrit !</h3></div>';
			header('refresh:3;url=login.php');
		} else {
			$msg = '<div id ="h2" <p> Impossible de s\'inscrire, contactez votre administrateur ! </p>';
			header('refresh:3;url=index.php');
		}
	}
}

unset($connection);
?>

</div>
</div>
<?php
include("footer.php");
?>