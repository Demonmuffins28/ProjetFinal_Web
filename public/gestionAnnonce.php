<?php
    $binAffichageAnnonce = false;
    require_once("barreNavigation.php");
?>
<a href="AjouterAnnonce.php">Ajouter Annonce</a>
<form action="ModifierAnnonce.php" method="post"">
    <input type="hidden" name="idAnnonce" value="27">
    <input type="submit" value="Modifier Annonce #27 Test">
</form>