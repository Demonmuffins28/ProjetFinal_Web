<?php
$binAffichageAnnonce = true;

require_once("barreNavigation.php");

// Variable pour images et sequence
$urlImages = "..";
$intNoSeq = 1;

if ($orderBy == "Categorie Asc") {
  $orderBy = "Description Asc";
} else if ($orderBy == "Categorie Desc") {
  $orderBy = "Description Desc";
} else if ($orderBy == "Etat Asc") {
  $orderBy = "Etat Asc";
} else if ($orderBy == "Etat Desc") {
  $orderBy = "Etat Desc";
} else if ($orderBy == "Description Asc") {
  $orderBy = "DescriptionAbregee Asc";
} else if ($orderBy == "Description Desc") {
  $orderBy = "DescriptionAbregee Desc";
}

// Requetes SQL pour les donnes de chaque annonces
$sql = 'SELECT * FROM annonces a INNER JOIN utilisateurs u ON u.NoUtilisateur = a.NoUtilisateur INNER JOIN categories c ON c.NoCategorie = a.Categorie WHERE a.NoUtilisateur=:ID ' . $recherche . ' ORDER BY ' . $orderBy;
$query = $mysql->cBD->prepare($sql);
$query->bindValue(':ID', $strNumUtil, PDO::PARAM_STR);
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
    $auteur = $annonce['Nom'] . " " . $annonce['Prenom'];
    $etat = $annonce['Etat'] == 1 ? 'Actif' : 'Inactif';
    $couleurEtat = $annonce['Etat'] == 1 ? 'lime' : 'red';

    // Recherche du nom de la categorie
    $sql = 'SELECT `Description` FROM categories WHERE NoCategorie=:ID';
    $query = $mysql->cBD->prepare($sql);
    $query->bindValue(':ID', $categorie, PDO::PARAM_STR);
    $query->execute();
    $nomCategorie = $query->fetchAll(PDO::FETCH_BOTH);
    foreach ($nomCategorie as $cat) {
      $descCategorie = $cat[0];
    }
  ?>

  <div class="annonce">
    <div class="card">
      <div class="annonces_content gerer_annonce">
        <div class="annonces_image">
          <img src="<?= $photo ?>" alt="..." class="annonces_image">
        </div>
        <div class="vertical-line"></div>
        <div class="annonce_textes">
          <div class="card-body">
            <h5 class="card-title titreAnnonce" dir="rtl"><a href="#" class="titreAnnonceLink"><?= $descAbregee ?></a>
            </h5>
            <ul class="list_annonce">
              <li class="card-text">Prix demandé : <?= $prix ?></li>
              <li class="card-text" style="color: <?= $couleurEtat ?>"><?= $etat ?></li>
              <li class="card-text">Catégorie : <?= $descCategorie ?></li>
              <li class="card-text"><?= $intNoSeq . "S." . $noAnnonce . "A." . $dateParution ?></li>
              <li class="card-text">
                <div class="divBtnAnnonce">
                  <form class="form_modif_annonce" action="ModifierAnnonce.php" method="post">
                    <input type="hidden" name="idAnnonce" value="<?= $noAnnonce ?>">
                    <button class="btn btn-outline-primary" type="submit">Modifier annonce</button>
                  </form>
                  <form class="form_supp_annonce" action="retirerAnnonce.php" method="post">
                    <input type="hidden" name="idAnnonce" value="<?= $noAnnonce ?>">
                    <input type="hidden" name="supprimer" value="true">
                    <button class="btn btn-outline-danger" type="submit">Supprimer annonce</button>
                  </form>
                </div>
              </li>
            </ul>
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
<button type="button" class="btn btn-primary big-blue-button" onclick="location.href='AjouterAnnonce.php'">
  <i class="fas fa-plus" style="font-size: xxx-large;"></i>
</button>
</body>

</html>