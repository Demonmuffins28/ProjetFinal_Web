<?php
    require_once("../dbconfig.php");
    $strEmail = isset($_POST["email"]) ? $_POST["email"] : null;
    if ($strEmail != null){
        $cBD = new PDO("mysql:host=localhost;dbname=$strNomBD", $strNomAdmin, $strMotPasseAdmin);
        $sql = "SELECT * FROM utilisateurs WHERE LOWER(Courriel) = LOWER('$strEmail')";
        $query = $cBD->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_BOTH);
        if (count($result) == 0){
            echo false;
        }
        else {
            echo true;
        }
    }
    else {
        echo false;
    }
?>