<?php
// connectBD( ): fonction de connection à la BD
// ENTREE:
//	> ---
// SORTIE: 
//	> [ $connection ]: si tout se passe bien
//	> [ exit()      ]: s'il y a un problème de connection
function ConnectionBD()
{
	try //essai de connection à la BD
	{
		//connection à la BD avec PDO
		$connection = new PDO('mysql:host=127.0.0.1;dbname=utilisateur','root','');
		
		//on dit à mysql de communiquer en UTF8
		$connection->exec('SET NAMES utf8');
		
		//on renvoie l'objet de connection
		return $connection;
	}
	catch(Exception $erreur) //en cas d'erreur la connection ne s'effectue pas 
	{
		echo '<erreur>Erreur [001]: Impossible de se connecter à la BD, veuillez contacter votre administrateur!</erreur><br/>';		
		echo '<erreur>Message : '.$erreur->getMessage().'</erreur><br/>';
		echo '<erreur>N° : '.$erreur->getCode().'</erreur><br/>';			
		
		//on arrête l'exécution s'il y a du code après
		exit();
	}   		
}

?>