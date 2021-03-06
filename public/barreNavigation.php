<?php
session_start();

require_once("classe-mysql.php");
require_once("libValidation.php");

function parametre($strIDParam, $binGet = false)
{
  return !$binGet ? (isset($_POST[$strIDParam]) ? ($_POST[$strIDParam] == '' ? null : $_POST[$strIDParam]) : null) : (isset($_GET[$strIDParam]) ? ($_GET[$strIDParam] == '' ? null : $_GET[$strIDParam]) : null);
}

$strNumUtil = $_SESSION["userID"];
// Si connecter redirection vers la page connexion
function aPageConnexion()
{
  header("Location: connexion.php");
  exit();
}

$strInfosSensibles = "../dbconfig.php";
$mysql = new mysql($strInfosSensibles);

$sql = 'SELECT Prenom, Nom, CouleurProfil FROM utilisateurs WHERE NoUtilisateur=:id';
$query = $mysql->cBD->prepare($sql);
$query->bindValue(':id', $strNumUtil, PDO::PARAM_STR);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if (count($result) == 0) {
  aPageConnexion();
} else {
  foreach ($result as $user) {
    $strPrenom = $user["Prenom"];
    $strNom = $user["Nom"];
    $strCouleur = $user["CouleurProfil"];
  }
}

$couleurPageCourante = "orangered";
$couleurPageNonCourante = "#0275d8"
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Les Petites Annonces GG</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="index.css">

  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
  <nav class="vertical-nav d-flex flex-column bg-dark" id="sidebar">
    <div class="px-2 py-4">
      <p class="nav_Categories font-weight-bold text-uppercase">MENU</p>
      <hr>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a href="menuPrincipale" class="nav-link text-light font-italic">
            <i class="fa fa-th-large fa-fw" style="color:<?= $couleurPageCourante ?>"></i>
            Afficher tous les annonces
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fa fa-cubes fa-fw" style="color:<?= $couleurPageNonCourante ?>"></i>
            G??rer vos annonces
          </a>
        </li>
        <li class="nav-item">
          <a href="gestionProfil.php" class="nav-link text-light font-italic">
            <i class="fa fa-address-card fa-fw" style="color:<?= $couleurPageNonCourante ?>"></i>
            Modifi?? votre profil
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fa fa-picture-o text-primary fa-fw"></i>
            Gallery
          </a>
        </li> -->
      </ul>
    </div>

    <?php if ($binAffichageAnnonce) { ?>
    <div class="px-2 py-4">
      <p class="nav_Categories font-weight-bold text-uppercase">Filtr?? par:</p>
      <hr>
      <ul class="nav flex-column ">
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fas fa-calendar-alt fa-fw" style="color:<?= $couleurPageNonCourante ?>"></i>
            Date de parition
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fas fa-archive fa-fw" style="color:<?= $couleurPageNonCourante ?>"></i>
            Cat??gorie
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fas fa-book fa-fw" style="color:<?= $couleurPageNonCourante ?>"></i>
            Description abr??g??e
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fas fa-clipboard-check fa-fw" style="color:<?= $couleurPageNonCourante ?>"></i>
            ??tat
          </a>
        </li>
      </ul>
    </div>
    <?php } ?>
    <div class="px-3 mt-auto">
      <div class="media d-flex align-items-center px-2">
        <label id="userImgWrap" style="background-color:<?= $strCouleur ?>; margin-top:-2.5rem"></label>
        <div class="media-body">
          <p class="font-weight-dark text-muted px-3" style=" margin-top: -1.5rem">Connect?? en tant que:</p>
          <p class=" font-weight-dark text-muted px-3" style=" margin-top: -1rem"><?= $strPrenom . " " . $strNom ?></p>
        </div>

      </div>
    </div>

    <div class="px-3" style="margin-bottom: 1rem">
      <a href="deconnexion.php" class="nav-link font-weight-dark text-muted">
        <i class="fas fa-sign-out-alt text-primary fa-fw"></i>
        D??connexion
      </a>
    </div>
  </nav>