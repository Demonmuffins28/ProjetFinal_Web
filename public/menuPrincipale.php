<?php
$binAffichageAnnonce = true;

require_once("barreNavigation.php");

// Variable pour images et sequence
$urlImages = "../images/annonces/";
$intNoSeq = 1;

// Requetes SQL pour les donnes de chaque annonces
$sql = 'SELECT * FROM annonces WHERE Etat=:Etat';
$query = $mysql->cBD->prepare($sql);
$query->bindValue(':Etat', "1", PDO::PARAM_STR);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_BOTH);
?>
<div class="annonces">
  <?php
  foreach ($result as $annonce) {
    $noAnnonce = $annonce[0];
    $noUtil = $annonce[1];
    $dateParution = $annonce[2];
    $dateParution = substr($dateParution, 0, 10);
    $categorie = $annonce[3];
    $descAbregee = $annonce[4];
    $descComplete = $annonce[5];
    $prix = $annonce[6] . "$";
    if ($prix == "0.00$") $prix = "N/A";
    $photo = $urlImages . $annonce[7];

    $sql = 'SELECT Prenom, Nom FROM utilisateurs WHERE NoUtilisateur=:ID';
    $query = $mysql->cBD->prepare($sql);
    $query->bindValue(':ID', $noUtil, PDO::PARAM_STR);
    $query->execute();
    $nomPrenom = $query->fetchAll(PDO::FETCH_BOTH);
    foreach ($nomPrenom as $nomAuteur) {
      $auteur = $nomAuteur[0] . " " . $nomAuteur[1];
    }

  ?>

  <div class="annonce">
    <div class="card">
      <div class="annonces_content">
        <div class="annonces_image" style="max-width: 144px">
          <img src="<?= $photo ?>" alt="..." style="max-width: 144px; max-height: 144px">
        </div>
        <div class="annonce_textes">
          <div class="card-body">
            <h5 class="card-title"><a href="#"><?= $descAbregee ?></a></h5>
            <ul class="list_annonce">
              <li class="card-text">Prix demandé : <?= $prix ?></li>
              <li><a href="#" class=card-text><?= $auteur ?></a></li>
              <li class="card-text">Date de parution : <?= $dateParution ?></li>
              <li class="card-text">No de l'annonce : <?= $noAnnonce ?></li>
              <li class="card-text">No Sequentiel : <?= $intNoSeq ?></li>
              <li><a href="#" class="btn btn-primary">Voir les détails</a></li>
            </ul>
            <!-- <p class="card-text">Prix demandé : <?= $prix ?></p>
              <a href="#" class=card-text><?= $auteur ?></a>
              <p class="card-text">Date de parution : <?= $dateParution ?></p>
              <p class="card-text">No de l'annonce : <?= $noAnnonce ?></p>
              <p class="card-text">No Sequentiel : <?= $intNoSeq ?></p> -->
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php
    $intNoSeq++;
  }
  ?>
</div>
</body>

</html>