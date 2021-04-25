<?php
session_start();
unset($_SESSION['userID']);
session_destroy();
$_SESSION['erreur'] = "Retour a la page de connexion!";
header('Location: connexion.php');