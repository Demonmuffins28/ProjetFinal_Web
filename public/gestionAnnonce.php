<?php
if ($_SESSION["nom"] == '' || $_SESSION["prenom"] == ''){
    header("Location: gestionProfil.php");
    exit();
  }
?>