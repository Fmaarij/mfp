<?php
session_start();
?>

<head>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/header and footer.css">



</head>


<!-- Main Container -->

<!-- Navigation -->
<div class="header_container">
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-rgb(150, 3, 3) text-center" style="background-color: rgb(150, 3, 3); height: 55px">
      <a class="navbar-brand" href="index.php">
        <img src="./img/logo.png" class="logo" id="logo" style="height: auto; width: 80px; ">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav" style="background-color: rgb(150, 3, 3); margin-left: 50%; padding-right: 30px; color: white">
        <div class="menu_container">
          <ul class="navbar-nav " style="text-align: right">

            <!--<li> <a href="galerie.php">GALERIE</a></li> -->
            <?php

            //on exécute la commande sql qui vérifie le login et mot de passe

            if (isset($_SESSION['login'])) {
              if ($_SESSION['role'] == 'membre') {
            ?>
                <li class="nav-item"> <a href="index.php" class="nav-link">ACCUEIL</a></li>
                <li class="nav-item"> <a href="contact.php" class="nav-link">CONTACT</a></li>
                <li class="nav-item"> <a href="video.php" class="nav-link">VIDEO</a></li>
                <!--  <li><?= $_SESSION['login']; ?></li> -->
                <li class="nav-item"> <a href="profile.php" class="nav-link">PROFILE</a></li>
                <li class="nav-item"> <a href="logout.php" class="nav-link">SE&nbsp;DÉCONNECTER</a></li>

              <?php
              } else if ($_SESSION['role'] == 'admin') {


              ?>
                <li class="nav-item"> <a href="index.php" class="nav-link">ACCUEIL</a></li>
                <li class="nav-item"> <a href="video.php" class="nav-link">VIDEO</a></li>
                <li class="nav-item"> <a href="AddVideo.php" class="nav-link">AJOUTER</a></li>
                <li class="nav-item"> <a href="editVideo.php" class="nav-link">MODIFIER/SUPPRIMER</a></li>
                <li class="nav-item"> <a href="profile.php" class="nav-link">PROFILE</a></li>
                <li class="nav-item"> <a href="logout.php" class="nav-link">SE&nbsp;DÉCONNECTER</a></li>
                <li class="nav-item"> <a href="Definir-role.php" class="nav-link">ROLE</a></li>
                <li class="nav-item"> <a href="genre.php" class="nav-link">GENRE</a></li>
              <?php


              }
            } else {
              ?>
              <li class="nav-item"><a href="index.php" class="nav-link">ACCUEIL</a></li>
              <!-- <li><a href="#about">A-PROPOS</a></li> -->
              <li class="nav-item"> <a href="contact.php" class="nav-link">CONTACT</a></li>
              <li class="nav-item"> <a href="login.php" class="nav-link">VIDEO</a></li>
              <li class="nav-item"> <a href="login.php" class="nav-link">CONNEXION</a></li>
              <li class="nav-item"> <a href="inscription.php" class="nav-link">INSCRIPTION</a></li>
            <?php
            }

            ?>

          </ul>
        </div>





  </header>
  <?php

  //on exécute la commande sql qui vérifie le login et mot de passe

  if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'membre') {
  ?>
      <div class="profile_name">
        <h2><?= $_SESSION['login']; ?></h2>
        <img class="profile_icon" src="./img/profile_icon.png">
      </div>


    <?php
    } else if ($_SESSION['role'] == 'admin') {

    ?>
      <div class="profile_name">
        <h2><?= $_SESSION['login']; ?> </h2>
        <img class="profile_icon" src="./img/profile_icon.png">
      </div>
  <?php


    }
  }

  ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


<!-- <div id="photo" style="position:center;background-repeat: no-repeat;background-size: cover; width:100%;height:380px;">
                <img style="position:relative;top:10%;width:100%;height:500px;" src="img/001.jpg" />      
			</div>-->



<!-- Main Container Ends -->