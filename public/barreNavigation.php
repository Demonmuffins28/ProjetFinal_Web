<?php
session_start();

function parametre($strIDParam)
{
  return filter_input(INPUT_GET, $strIDParam, FILTER_SANITIZE_SPECIAL_CHARS) .
    filter_input(INPUT_POST, $strIDParam, FILTER_SANITIZE_SPECIAL_CHARS);
}

$_SESSION["binConnecter"] = isset($_SESSION["binConnecter"]) ? $_SESSION["binConnecter"] : false;
// Si connecter redirection vers la page connexion
if ($_SESSION["binConnecter"]) {
  header("Location: connexion.php");
  exit();
}

$binAffichageAnnonce = true;
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
</head>

<body>
  <nav class="vertical-nav d-flex flex-column bg-dark" id="sidebar">
    <div class="px-2 py-4">
      <p class="nav_Categories font-weight-bold text-uppercase">Main</p>
      <hr>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fa fa-th-large text-primary fa-fw"></i>
            Afficher tous les annonces
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fa fa-cubes text-primary fa-fw"></i>
            Gérer vos annonces
          </a>
        </li>
        <li class="nav-item">
          <a href="gestionProfil.php" class="nav-link text-light font-italic">
            <i class="fa fa-address-card text-primary fa-fw"></i>
            Modifié votre profil
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
      <p class="nav_Categories font-weight-bold text-uppercase">Filtré par:</p>
      <hr>
      <ul class="nav flex-column ">
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fas fa-calendar-alt text-primary fa-fw"></i>
            Date de parition
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fas fa-archive text-primary fa-fw"></i>
            Catégorie
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fas fa-book text-primary fa-fw"></i>
            Description abrégée
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-light font-italic">
            <i class="fas fa-clipboard-check text-primary fa-fw"></i>
            État
          </a>
        </li>
      </ul>
    </div>
    <?php } ?>
    <div class="px-3 mt-auto">
      <div class="media d-flex align-items-center px-2"><img src="../images/profil1.jpg" alt="..." width="50"
          height="50" class="mr-3 rounded-circle shadow-sm">
        <div class="media-body">
          <h4 class="">Nom_Utilisateur</h4>
          <p class="font-weight-dark text-muted px-3" style=" margin-top: -1.5rem">Connecté en tant que:</p>
          <p class=" font-weight-dark text-muted px-3" style=" margin-top: -1rem">Nom_Utilisateur</p>
        </div>
      </div>
    </div>

    <div class="px-3" style="margin-bottom: 1rem">
      <a href="#" class="nav-link font-weight-dark text-muted">
        <i class="fas fa-sign-out-alt text-primary fa-fw"></i>
        Déconnexion
      </a>
    </div>
  </nav>