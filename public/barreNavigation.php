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
function redirect($pageURL)
{
  header($pageURL);
}

$strInfosSensibles = "../dbconfig.php";
$mysql = new mysql($strInfosSensibles);

$sql = 'SELECT Prenom, Nom, CouleurProfil FROM utilisateurs WHERE NoUtilisateur=:id';
$query = $mysql->cBD->prepare($sql);
$query->bindValue(':id', $strNumUtil, PDO::PARAM_STR);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if (count($result) == 0) {
  redirect("Location: connexion.php");
} else {
  foreach ($result as $user) {
    $strPrenom = $user["Prenom"];
    $strNom = $user["Nom"];
    $strCouleur = $user["CouleurProfil"];
  }
}

$strPageActive = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$couleurPageCourante = "orangered";
$couleurPageNonCourante = "#0275d8";
$couleur2ePageNonCourante = "#f0f0f0";

// Pour le fonctions de filtrage
// Quelle page somme nous
if (!isset($_GET['page'])) {
  $page = 1;
} else $page = $_GET['page'];
// Variable pour le nombre de resultat par page
if (!isset($_GET['nbPage'])) {
  $annonceParPage = 10;
} else $annonceParPage = $_GET['nbPage'];
// Pour le orderBy
if (!isset($_GET['orderBy'])) {
  $orderBy = "Parution Desc";
} else {
  // Ajuster les requetes pour les categories et les noms/prenoms
  $orderBy = $_GET['orderBy'];
}
if (isset($_GET['recherche']) && $_GET['recherche'] != "") {
  $recherche = "'%" . $_GET['recherche'] . "%'";
  $recherche = " AND (Parution Like " . $recherche . " OR Nom Like " . $recherche . " OR Prenom Like " . $recherche . " OR Description Like " . $recherche . " OR DescriptionAbregee Like " . $recherche . ")";
} else {
  $recherche = "";
}
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
            <i class="fa fa-th-large fa-fw"
              style="color:<?= $strPageActive == "menuPrincipale.php" ? $couleurPageCourante : $couleurPageNonCourante ?>"></i>
            Afficher tous les annonces
          </a>
        </li>
        <li class="nav-item">
          <a href="gestionAnnonce.php" class="nav-link text-light font-italic">
            <i class="fa fa-cubes fa-fw"
              style="color:<?= $strPageActive == "gestionAnnonce.php" ? $couleurPageCourante : $couleurPageNonCourante ?>"></i>
            Gérer vos annonces
          </a>
        </li>
        <li class=" nav-item">
          <a href="gestionProfil.php" class="nav-link text-light font-italic">
            <i class="fa fa-address-card fa-fw"
              style="color:<?= $strPageActive == "gestionProfil.php" ? $couleurPageCourante : $couleurPageNonCourante ?>"></i>
            Modifié votre profil
          </a>
        </li>
      </ul>
    </div>

    <?php if ($binAffichageAnnonce) { ?>
    <div class="px-2 py-4">
      <p class="nav_Categories font-weight-bold text-uppercase">Filtré par:</p>
      <hr>
      <ul class="nav flex-column ">
        <li class="nav-item">
          <a href="<?= $strPageActive ?>?page=<?= $page ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy == "Parution Asc" ? "Parution Desc" : "Parution Asc" ?>&recherche=<?= $recherche ?>"
            class="nav-link text-light font-italic">
            <i class="fas fa-calendar-alt fa-fw text-primary"></i>
            Date de parition
            <i class="fas fa-arrow-alt-circle-up"
              style="color:<?= $orderBy == "Parution Asc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
            <i class="fas fa-arrow-alt-circle-down"
              style="color:<?= $orderBy == "Parution Desc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
          </a>

        </li>
        <li class="nav-item">
          <a href="<?= $strPageActive ?>?page=<?= $page ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy == "Categorie Asc" ? "Categorie Desc" : "Categorie Asc" ?>&recherche=<?= $recherche ?>"
            class="nav-link text-light font-italic">
            <i class="fas fa-archive fa-fw text-primary"></i>
            Catégorie
            <i class="fas fa-arrow-alt-circle-up"
              style="color:<?= $orderBy == "Categorie Asc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
            <i class="fas fa-arrow-alt-circle-down"
              style="color:<?= $orderBy == "Categorie Desc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= $strPageActive ?>?page=<?= $page ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy == "Description Asc" ? "Description Desc" : "Description Asc" ?>&recherche=<?= $recherche ?>"
            class="nav-link text-light font-italic">
            <i class="fas fa-copy fa-fw text-primary"></i>
            Descriptions
            <i class="fas fa-arrow-alt-circle-up"
              style="color:<?= $orderBy == "Description Asc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
            <i class="fas fa-arrow-alt-circle-down"
              style="color:<?= $orderBy == "Description Desc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
          </a>
        </li>
        <?php
          if ($strPageActive == "menuPrincipale.php") {
          ?>
        <li class="nav-item">
          <a href="<?= $strPageActive ?>?page=<?= $page ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy == "NomPrenom Asc" ? "NomPrenom Desc" : "NomPrenom Asc" ?>&recherche=<?= $recherche ?>"
            class="nav-link text-light font-italic">
            <i class="fas fa-at fa-fw text-primary"></i>
            Auteurs
            <i class="fas fa-arrow-alt-circle-up"
              style="color:<?= $orderBy == "NomPrenom Asc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
            <i class="fas fa-arrow-alt-circle-down"
              style="color:<?= $orderBy == "NomPrenom Desc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
          </a>
        </li>
        <?php
          } else {
          ?>
        <li class="nav-item">
          <a href="<?= $strPageActive ?>?page=<?= $page ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy == "Etat Asc" ? "Etat Desc" : "Etat Asc" ?>&recherche=<?= $recherche ?>"
            class="nav-link text-light font-italic">
            <i class="fas fa-unlock fa-fw text-primary"></i>
            État des annonces
            <i class="fas fa-arrow-alt-circle-up"
              style="color:<?= $orderBy == "Etat Asc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
            <i class="fas fa-arrow-alt-circle-down"
              style="color:<?= $orderBy == "Etat Desc" ? $couleurPageCourante : $couleur2ePageNonCourante ?>"></i>
          </a>
        </li>
        <?php } ?>
        <li>
          <form class="d-flex" style="transform: scale(0.9)">
            <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Recherche"
              name="recherche">
            <button class="btn btn-outline-primary" type="submit">Rechercher</button>
          </form>
        </li>
      </ul>
    </div>

    <?php } ?>
    <div class="px-3 mt-auto">
      <div class="media d-flex align-items-center px-2">
        <label id="userImgWrap" style="background-color:<?= $strCouleur ?>; margin-top:-2.5rem"></label>
        <div class="media-body">
          <p class="font-weight-dark text-muted px-3" style=" margin-top: -1.5rem">Connecté en tant que:</p>
          <p class=" font-weight-dark text-muted px-3" style=" margin-top: -1rem"><?= $strPrenom . " " . $strNom ?></p>
        </div>

      </div>
    </div>

    <div class="px-3" style="margin-bottom: 1rem">
      <a href="deconnexion.php" class="nav-link font-weight-dark text-muted">
        <i class="fas fa-sign-out-alt text-primary fa-fw"></i>
        Déconnexion
      </a>
    </div>
  </nav>