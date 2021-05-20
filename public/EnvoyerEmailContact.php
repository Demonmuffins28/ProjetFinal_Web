<?php
    session_start();
    require_once("../dbconfig.php");
    require_once("envoyerMail.php");

    $strEmail = isset($_POST["email"]) ? $_POST["email"] : null;
    $strMessage = isset($_POST["message"]) ? $_POST["message"] : null;
    $strTitre = isset($_POST["titre"]) ? $_POST["titre"] : null;
    echo $strTitre;
    if ($strEmail != null && $strMessage != null && $strTitre !=null) {
        envoyerMail($strEmail, "Réponse de ".$_SESSION['prenom']." ".$_SESSION['nom']." à votre annonce : $strTitre", $strMessage);
    }
?>