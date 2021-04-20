<?php
$binAffichageAnnonce = false;

require_once("barreNavigation.php");

$strNumUtil = parametre("email");
$strNumUtil = "2";

if (!isset($_GET['modifApporter'])) {
  $sql = 'SELECT * FROM utilisateurs WHERE NoUtilisateur=:id';
  $query = $mysql->cBD->prepare($sql);
  $query->bindValue(':id', $strNumUtil, PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  foreach ($result as $user) {
    $strNom = $user['Nom'];
    $strPrenom = $user['Prenom'];
    $strEmail = $user['Courriel'];
    $strTelMaison = $user['NoTelMaison'];
    $strTelTravail = $user['NoTelTravail'];
    $strTelCellulaire = $user['NoTelCellulaire'];
    $strStatus = $user['Statut'];
    $strNumUtil = $user['NoUtilisateur'];
  }
} else {
  $strNom = parametre("nom");
  $strPrenom = parametre("prenom");
  $strEmail = parametre("email");
  $strTelMaison = parametre("telMaison");
  $strTelTravail = parametre("telTravail");
  $strTelCellulaire = parametre("telCellulaire");

  $sql = 'UPDATE utilisateurs SET Nom=?, Prenom=?, Courriel=?, NoTelMaison=?, NoTelTravail=?, NoTelCellulaire=? WHERE NoUtilisateur=?';
  $query = $mysql->cBD->prepare($sql)->execute([$strNom, $strPrenom, $strEmail, $strTelMaison, $strTelTravail, $strTelCellulaire, $strNumUtil]);
}

$strPublic = parametre("checkPublic");
$strCouleur = parametre("couleurProfil");
$strCouleur = "#e66465";

if (!isset($_GET['modifApporter'])) {
?>
<div class="imgProfil">
  <label id="test_wrapper" style="background-color:<?= $strCouleur ?>">
    <div>
      <div class="colText">Clicker sur la couleur pour changer votre
        couleur de profil</div>
      <input type="color" id="primary_color" class="field-radio" name="primary-color" @change="changeColor()">
    </div>
  </label>
</div>

<form class="frmModificationProfil" method="get" action="" style="margin-top: 30px">
  <div id="divinscription" class="row mb-5">
    <div class="col-sm-8">
      <h1 class="headerProfil">Modifier votre profil</h1>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputNom" class="col-sm-3 col-form-label">Nom</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputNom" name="nom" value="<?= $strNom ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPrenom" class="col-sm-3 col-form-label">Prenom</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputPrenom" name="prenom" value="<?= $strPrenom ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputCourriel" class="col-sm-3 col-form-label">Courriel</label>
    <div class="col-sm-8">
      <input type="email" class="form-control inputFields" id="inputCourriel" name="email" value="<?= $strEmail ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="profChangPass" class="col-sm-3 col-form-label">Mot de passe</label>
    <div class="col-sm-8">
      <button type="submit" class="btn inputFields btnPass">Clicker pour changer votre mot de passe</button>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputTeleMaison" class="col-sm-3 col-form-label">Téléphone à la maison
      <br />(facultatif)
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputTeleMaison" name="telMaison"
        value="<?= $strTelMaison ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputTeleTravail" class="col-sm-4 col-form-label">Téléphone (poste) au travail
      <br />(facultatif)</label>
    <div class="col-sm-7">
      <input type="text" class="form-control inputFields" id="inputTeleTravail" name="telTravail"
        value="<?= $strTelTravail ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputCellulaire" class="col-sm-3 col-form-label">Téléphone cellulaire <br />(facultatif)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputCellulaire" name="telCellulaire"
        value="<?= $strTelCellulaire ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="selectStatut" class="col-sm-3 col-form-label">Status de l'utilisateur</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="selectStatut" disabled name="status"
        value="<?= $strStatus ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="affichageNumUtil" class="col-sm-3 col-form-label">Numéro de l'utilisateur</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="affichageNumUtil" disabled name="numero"
        value="<?= $strNumUtil ?>">
    </div>
  </div>
  <div class="col-sm-10">
    <div class="form-check col-sm-10">
      <input class="form-check-input " type="checkbox" id="gridCheck" name="checkPublic">
      <label class="col-form-label" for="gridCheck">
        Rendre vos information public lors de l'affichage d'annonce?
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="modifApporter">Ajouter les modifications</button>
</form>
<?php
} else {
?>
<h1 style=" padding-left: 10rem; padding-right: 35rem; padding-top: 10rem">Les modifications sur votre profil on été
  ajouter avec succès.
  <?= $strPublic ?></h1>

<?php
}
?>
<script>
let color_picker = document.getElementById("primary_color");
let color_picker_wrapper = document.getElementById("test_wrapper");
color_picker.onchange = function() {
  color_picker_wrapper.style.background = color_picker.value;
}
</script>
</body>

</html>