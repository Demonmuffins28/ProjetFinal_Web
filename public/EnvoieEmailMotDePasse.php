<?php
    require_once("../dbconfig.php");
    require_once("envoyerMail.php");

    $strEmail = isset($_POST["email"]) ? $_POST["email"] : null;
    if ($strEmail != null){
        $cBD = new PDO("mysql:host=localhost;dbname=$strNomBD", $strNomAdmin, $strMotPasseAdmin);
        $sql = "SELECT MotDePasse FROM utilisateurs WHERE LOWER(Courriel) = LOWER('$strEmail')";
        $query = $cBD->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_BOTH);
        if (count($result) == 0){
            echo false;
        }
        else {
            envoyerMail("wiwiwa8764@laraskey.com", "Mot de passe oublier", $result[0]["MotDePasse"]);
            echo true;
        }
    }
    else {
        echo false;
    }
?>