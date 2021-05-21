<?php 
$binAffichageAnnonce = false;
require_once("barreNavigation.php");

$strAnnonce = parametre("idAnnonce");

//Send a request to the database
//Check si l'etat est
$sql = "SELECT u.NoUtilisateur, u.Nom, u.Prenom, u.NoTelMaison, u.NoTelTravail, u.NoTelCellulaire, a.Parution, a.Prix, a.DescriptionAbregee Titre, c.Description Categorie, a.DescriptionComplete, a.Photo, a.MiseAJour
FROM annonces a
INNER JOIN utilisateurs u
ON u.NoUtilisateur = a.NoUtilisateur 
INNER JOIN categories c 
ON c.NoCategorie = a.Categorie
WHERE a.NoAnnonce = ".$strAnnonce;

$query = $mysql->cBD->prepare($sql);
$query->bindValue(':Etat', "1", PDO::PARAM_STR);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_BOTH);
//var_dump($result);


//Photo
$photo = ".." . $result[0]['Photo'];
//Titre
$titre = $result[0]['Titre'];
//Catégorie
$categorie = $result[0]['Categorie'];
//Description Complete
$descComplete = $result[0]['DescriptionComplete'];
//Prix
$prix = $result[0]['Prix']." $";
if ($prix == "0.00 $") $prix = "N/A";
//Auteur
$auteur = $result[0]['Nom'] . " " . $result[0]['Prenom'];
//Telephone Maison
$telMaison = $result[0]['NoTelMaison'];
$telMaison = (strpos($telMaison, "N") !== false) ? str_replace("N", "", $telMaison): "N/A";
//Telephone Travail
$telTravail = $result[0]['NoTelTravail'];
$telTravail = (strpos($telTravail, "N") !== false) ? str_replace("N", "", $telTravail): "N/A";
//Telephone Cell
$telCell = $result[0]['NoTelCellulaire'];
$telCell = (strpos($telCell, "N") !== false) ? str_replace("N", "", $telCell): "N/A";
//Date de parution (AAAA-MM-JJ, 99h99; format 24 heures);
$dateParution = $result[0]['Parution'];
$dateParution = substr($dateParution, 0, 16);
$dateParution = str_replace(":", "h", $dateParution);
$noUtil = $result[0]['NoUtilisateur'];
//Mise a jour
$miseAJour = $result[0]['MiseAJour'];
$miseAJour = substr($miseAJour, 0, 16);
$miseAJour = str_replace(":", "h", $miseAJour);


?>
<div class="container text-white rounded rounded-3" style="box-shadow: 1px 4px 10px black;
  background-color: #212529;">
  <div class="row m-5">
    <div class="col-12 py-5">
      <h1 class="fw-bolder"><?=$categorie?> : <?=$titre?></h1>
      <h4 class ="text-success"><?=$prix?></h4>
      <h5 class ="text-secondary"><?=$dateParution?> - Annonce #<?=$strAnnonce?></h5>
      <div class="row">
        <div class="col-6">
          <img style="width: 600px; height: 480px;" src="<?=$photo?>"/>
        </div>
        <div class="col-6 ps-5">
          <h3 class="fw-bold">Description :</h3>
          </br>
          <p class="fs-4"><?=$descComplete?></p>
        </div>
      <div>
      <div class="row pt-4">
        <div class="col-9">
          <form id="idFormContact<?=$noUtil?>" class="m-0" method="POST" action="Contact.php">
            <input type="hidden" name="noUtilisateur" value="<?=$noUtil?>">
            <a href="#" style="text-decoration: none;" onclick="document.getElementById('idFormContact<?=$noUtil?>').submit()"><h4 class="link-warning"><i class="fas fa-user"></i> <?=$auteur?></h4></a>
          </form>
          <h5><i class="fas fa-home"></i> : <?=$telMaison?></h5>
          <h5><i class="fas fa-building"></i> : <?=$telTravail?></h5>
          <h5><i class="fas fa-mobile-alt"></i> : <?=$telCell?></h5>
        </div>
        <div class="col-3 ps-5">
          </br></br></br></br>
          <h5><i class="fas fa-clock"></i> <?=$miseAJour?></h5>
        </div>
      <div>

        </div>
      </div>
    </div>
  </div>
</div>
