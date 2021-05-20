<?php
require_once("envoyerMail.php");
require_once("classe-mysql.php");

$strEmail = isset($_POST["email"]) ? $_POST["email"] : null;
if ($strEmail != null) {
    $strInfosSensibles = "../dbconfig.php";
    $mysql = new mysql($strInfosSensibles);
    $sql = "SELECT MotDePasse FROM utilisateurs WHERE LOWER(Courriel) = LOWER('$strEmail')";
    $query = $mysql->cBD->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_BOTH);
    if (count($result) == 0) {
        echo false;
    } else {
        envoyerMail($strEmail, "Demande de changement de mot de passe", "Suivre le lien pour changer votre mot de passe : " . "http://localhost/ProjetFinal_Web/public/changerOublierMotDePasse.php?id=" . $mysql->getNoUtilisateurs($strEmail));
        echo true;
    }
} else {
    echo false;
}