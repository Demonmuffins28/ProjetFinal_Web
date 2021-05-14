<?php
$binAffichageAnnonce = true;

require_once("barreNavigation.php");

// Variable pour images et sequence
$urlImages = "..";
$intNoSeq = 1;

// Requetes SQL pour les donnes de chaque annonces
$sql = 'SELECT * FROM annonces WHERE Etat=:Etat ORDER BY ' . $orderBy;
$query = $mysql->cBD->prepare($sql);
$query->bindValue(':Etat', "1", PDO::PARAM_STR);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_BOTH);

// quantite d'annonce en tout
$intNbAnnonce = count($result);
// quantite de page a faire
$nbPages = ceil($intNbAnnonce / $annonceParPage);
// Limiter le nombre de page a afficher
$limitAffichagePage = ($page - 1) * $annonceParPage;

// Verifier si on est pas dans un page dans le vide ************************BUG AVEC Changement entre page ***********************
if ($page > $nbPages) {
  $page = $nbPages;
  redirect("Refresh:0; url=menuPrincipale.php?page=$page&nbPage=$annonceParPage&orderBy=$orderBy");
}
?>
<div class="annonces">
  <?php
  for ($i = $limitAffichagePage; $i < $limitAffichagePage + $annonceParPage && $i < $intNbAnnonce; $i++) {
    $noAnnonce = $result[$i][0];
    $noUtil = $result[$i][1];
    $dateParution = $result[$i][2];
    $dateParution = substr($dateParution, 0, 10);
    $categorie = $result[$i][3];
    $descAbregee = $result[$i][4];
    $descComplete = $result[$i][5];
    $prix = $result[$i][6] . "$";
    if ($prix == "0.00$") $prix = "N/A";
    $photo = $urlImages . $result[$i][7];

    // Recherche du nom et prenom de l'auteur
    $sql = 'SELECT Prenom, Nom FROM utilisateurs WHERE NoUtilisateur=:ID';
    $query = $mysql->cBD->prepare($sql);
    $query->bindValue(':ID', $noUtil, PDO::PARAM_STR);
    $query->execute();
    $nomPrenom = $query->fetchAll(PDO::FETCH_BOTH);
    foreach ($nomPrenom as $nomAuteur) {
      $auteur = $nomAuteur[0] . " " . $nomAuteur[1];
    }

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
      <div class="annonces_content">
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
              <li class="card-text"><a href="#" class="nomPrenomLien"><?= $auteur ?></a></li>
              <li class="card-text">Catégorie : <?= $descCategorie ?></li>
              <li class="card-text"><?= $intNoSeq . "S." . $noAnnonce . "A." . $dateParution ?></li>
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
<div class='noPage'>
  <div class="dropdown">
    <div class="dropdown_content">
      <a href="menuPrincipale.php?nbPage=20&page=<?= $page ?>">20 par page</a>
      <a href="menuPrincipale.php?nbPage=15&page=<?= $page ?>">15 par page</a>
      <a href="menuPrincipale.php?nbPage=10&page=<?= $page ?>">10 par page</a>
      <a href="menuPrincipale.php?nbPage=5&page=<?= $page ?>">5 par page</a>
    </div>
    <button class="dropbtn">Annonces par page [<?= $annonceParPage ?>]</button>
  </div>
  <div>
    <a class="" href="menuPrincipale.php?page=<?= 1 ?>&nbPage=<?= $annonceParPage ?>"><i
        class="fas fa-angle-double-left changePage"></i></a>
    <a class="" href="menuPrincipale.php?page=<?= $page == 1 ? 1 : $page - 1 ?>&nbPage=<?= $annonceParPage ?>"><i
        class="fas fa-angle-left changePage" style="transform: scale(2)"></i></a>

    <?php
    for ($i = 1; $i <= $nbPages; $i++) {
      if ($i == $page)
        echo "<a class='lienPage lienPageActive btn btn-primary' href='menuPrincipale.php?page=" . $i . '&nbPage=' . $annonceParPage . "'>" . $i . " </a>";
      else
        echo "<a class='lienPage btn btn-primary' href='menuPrincipale.php?page=" . $i . '&nbPage=' . $annonceParPage . "'>" . $i . " </a>";
    }
    ?>
    <a class=""
      href="menuPrincipale.php?page=<?= $page == $nbPages ? $nbPages : $page + 1 ?>&nbPage=<?= $annonceParPage ?>"><i
        class="fas fa-angle-right changePage" style="transform: scale(2)"></i></a>
    <a class="" href="menuPrincipale.php?page=<?= $nbPages ?>&nbPage=<?= $annonceParPage ?>"><i
        class="fas fa-angle-double-right changePage"></i></a>
  </div>
</div>
</body>

</html>