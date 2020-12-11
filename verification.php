 
<?php
session_start();

/*if(isset($_POST['username']) && isset($_POST['password']))
{*/
// connexion à la base de données
include('lib/php/fonctions.php');
$connection = ConnectionBD();

// on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
// pour éliminer toute attaque de type injection SQL et XSS
/*  $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateur where 
              userID = '".$username."' and mot_de_passe = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['login'] = $username;
           header('Location: video.php');
        }
        else
        {
           header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
?>



*/

if (isset($_POST["btnConnection"])) {
    $connection = ConnectionBD();
    //on récupere les données du formulaire
    $login = $_POST['username'];
    $mdp   = $_POST['password'];

    //cryptage du mot de passe
    /*$mdp = md5( $mdp );*/

    //préparation de la requête pour l'insertion des données dans la BD
    $sql = ("SELECT * FROM utilisateur WHERE userID='$login'AND mot_de_passe='$mdp'");
    //on exécute la commande sql qui vérifie le login et mot de passe
    $resultats = $connection->query($sql);
    if ($resultats->rowCount() == 0) {
        header('refresh:2;url=inscription.php');
    }
    //rowCount() retourne le nombre de lignes trouvées
    //si aucune ligne n'est trouvée, la fonction rowCount() retournera 0
    else if ($resultats->rowCount() > 0) {
        $_SESSION['login'] = $login;

        //récupération du résultat obtenu (un seul possible, car login devrait être unique)
        $utilisateur = $resultats->fetch(PDO::FETCH_BOTH);

        //création de la variable de session "$_SESSION['id']"
        $_SESSION['login'] = $utilisateur['userID'];

        //création de la variable de session "$_SESSION['admin']"
        $_SESSION['role'] = $utilisateur['role'];
        if ($utilisateur['role'] == 'membre') {

            $msg = '<div id ="h2"><h3>Vous etes connecté  : ' . $_SESSION['login'] . '</h3></div>';
            header('refresh:2;url=video.php');
        } else if ($utilisateur['role'] == 'admin') {
            $msg = '<div id ="h2"><h3>Vous etes connecté  : ' . $_SESSION['login'] . '</h3></div>';
            header('refresh:2;url=index.php');
        } else {
            header('refresh:2;url=index.php');
        }
    } else {
        $msg = '<div id ="h2"><h3>Mauvais identifiants !</h3></div>';
        header('refresh:3;url=index.php');
    }
}
