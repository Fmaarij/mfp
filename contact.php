<?php
include("menu.php");
include('lib/php/fonctions.php');
?>

<!-- Main Container -->

<head>
  <link rel="stylesheet" href="./css/style2.css">
</head>


<!-- More Info Section -->

<!-- Formaulaire -->
<div class="contact_page_container"  style="height: 100%; display:flex; justify-content:center; margin-top: 220px; margin-bottom: 70px">
<div class="contact_form"">
  <a href="#logo" id="haut"></a>
  <form id="form" action="mailto:maarij_faisal@hotmail.com" method="get" enctype="text/plain">
    <h3 style="text-align:center; padding: 10px"> Contact Rapide</h3>
    <h4 style="text-align:center; padding: 10px">Contactez-nous aujourd'hui et obtenez une réponse dans les 24 heures!</h4>
    <fieldset>
      <input placeholder="Votre Nom" type="text" tabindex="1" required style="width: 100%; height: 50px; margin-bottom: 10px">
    </fieldset>
    <fieldset>
      <input placeholder="Votre Mail" type="email" tabindex="2" required style="width: 100%; height: 50px; margin-bottom: 10px">
    </fieldset>
    <fieldset>
      <input placeholder="Votre Num&eacute;ro" type="tel" tabindex="3" required style="width: 100%; height: 50px; margin-bottom: 10px">
    </fieldset>
    <fieldset>
      <textarea placeholder="Tapez votre message ici...." tabindex="5" required style="width: 100%; height: 200px"></textarea>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="btn">Soumettre</button>
    </fieldset>

  </form>


</div>
</div>

<!-- Main Container Ends -->
<?php
include("footer.php");
?>