<?php
$binAffichageAnnonce = true;

require_once("barreNavigation.php");

// Variable pour images et sequence
$urlImages = "..";
$intNoSeq = 1;

if ($orderBy == "NomPrenom Desc") {
  $orderBy = "Nom Desc, Prenom Desc";
} else if ($orderBy == "NomPrenom Asc") {
  $orderBy = "Nom Asc, Prenom Asc";
} else if ($orderBy == "Categorie Asc") {
  $orderBy = "Description Asc";
} else if ($orderBy == "Categorie Desc") {
  $orderBy = "Description Desc";
} else if ($orderBy == "Description Asc") {
  $orderBy = "DescriptionAbregee Asc";
} else if ($orderBy == "Description Desc") {
  $orderBy = "DescriptionAbregee Desc";
}

// Requetes SQL pour les donnes de chaque annonces
$sql = 'SELECT * FROM annonces a INNER JOIN utilisateurs u ON u.NoUtilisateur = a.NoUtilisateur INNER JOIN categories c ON c.NoCategorie = a.Categorie WHERE Etat=:Etat ' . $recherche . ' ORDER BY ' . $orderBy;
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

// Verifier si on est pas dans un page dans le vide
if ($page > $nbPages) {
  $page = $nbPages;
  echo "<script> window.location.href='menuPrincipale.php?page=$page&nbPage=$annonceParPage&orderBy=$orderBy' </script>";
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
    $auteur = $result[$i]['Nom'] . " " . $result[$i]['Prenom'];

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
              <form id="idFormContact<?= $noAnnonce ?>" class="m-0" method="POST" action="Contact.php">
                <input type="hidden" name="noUtilisateur" value="<?= $noUtil ?>">
                <input type="hidden" name="titre" value="<?= $descAbregee ?>">
                <input type="hidden" name="prix" value="<?= $prix ?>">
                <li class="card-text"><a href="#"
                    onclick="document.getElementById('idFormContact<?= $noAnnonce ?>').submit()"
                    class="nomPrenomLien"><?= $auteur ?></a></li>
              </form>
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
      <a href="menuPrincipale.php?nbPage=20&page=<?= $page ?>&orderBy=<?= $orderBy ?>">20 par page</a>
      <a href="menuPrincipale.php?nbPage=15&page=<?= $page ?>&orderBy=<?= $orderBy ?>">15 par page</a>
      <a href="menuPrincipale.php?nbPage=10&page=<?= $page ?>&orderBy=<?= $orderBy ?>">10 par page</a>
      <a href="menuPrincipale.php?nbPage=5&page=<?= $page ?>&orderBy=<?= $orderBy ?>">5 par page</a>
    </div>
    <button class="dropbtn">Annonces par page [<?= $annonceParPage ?>]</button>
  </div>
  <div>
    <a class=""
      href="menuPrincipale.php?page=<?= 1 ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy ?>&recherche=<?= $recherche ?>"><i
        class="fas fa-angle-double-left changePage"></i></a>
    <a class=""
      href="menuPrincipale.php?page=<?= $page == 1 ? 1 : $page - 1 ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy ?>&recherche=<?= $recherche ?>"><i
        class="fas fa-angle-left changePage" style="transform: scale(2)"></i></a>

    <?php
    for ($i = 1; $i <= $nbPages; $i++) {
      if ($i == $page)
        echo "<a class='lienPage lienPageActive btn btn-primary' href='menuPrincipale.php?page=" . $i . '&nbPage=' . $annonceParPage . "&orderBy=" . $orderBy . "&recherche=" . $recherche . "'>" . $i . " </a>";
      else
        echo "<a class='lienPage btn btn-primary' href='menuPrincipale.php?page=" . $i . '&nbPage=' . $annonceParPage . "&orderBy=" . $orderBy . "'>" . $i . " </a>";
    }
    ?>
    <a class=""
      href="menuPrincipale.php?page=<?= $page == $nbPages ? $nbPages : $page + 1 ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy ?>"><i
        class="fas fa-angle-right changePage" style="transform: scale(2)"></i></a>
    <a class=""
      href="menuPrincipale.php?page=<?= $nbPages ?>&nbPage=<?= $annonceParPage ?>&orderBy=<?= $orderBy ?>&recherche=<?= $recherche ?>"><i
        class="fas fa-angle-double-right changePage"></i></a>
  </div>
</div>
</body>

</html>