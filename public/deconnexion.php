<?php
session_start();
require_once("classe-mysql.php");
$strInfosSensibles = "../dbconfig.php";
$mysql = new mysql($strInfosSensibles);

// Ajouter date connexion
date_default_timezone_set("America/New_York");
$sql = 'UPDATE connexions SET Deconnexion=CURRENT_TIMESTAMP WHERE NoConnexion=' . $_SESSION['connexionID'];
$query = $mysql->cBD->prepare($sql)->execute();

// fermer session
unset($_SESSION['userID']);
unset($_SESSION['connexionID']);
session_destroy();
$_SESSION['erreur'] = "Retour a la page de connexion!";
header('Location: connexion.php');