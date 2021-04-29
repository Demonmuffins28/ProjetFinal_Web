<?php

$binAffichageAnnonce = false;

require_once("barreNavigation.php");


$strPassword = parametre("password1");

if (isset($_POST['modifApporter'])) {
  try {
    $sql = 'UPDATE utilisateurs SET MotDePasse=? WHERE NoUtilisateur=?';
    $query = $mysql->cBD->prepare($sql)->execute([$strPassword, $strNumUtil]);
  } catch (Exception $e) {
    die("Erreur dans la requete!");
  }
}

if (!isset($_POST['modifApporter'])) {
?>
<form class=" frmModificationProfil" id="frmSaisi" method="POST" action="changerMotDePasse.php"
  style="margin-top: 30px">
  <div id="divinscription" class="row mb-5">
    <div class="col-sm-8">
      <h1 class="headerProfil">Changer votre mot de passe</h1>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputNom" class="col-sm-3 col-form-label">Nouveau mot de passe</label>
    <div class="col-sm-6">
      <input type="password" class="form-control inputFields" id="password1" name="password1">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPrenom" class="col-sm-3 col-form-label">Confirmer le mot de passe</label>
    <div class="col-sm-6">
      <input type="password" class="form-control inputFields" id="password2" name="password2">
    </div>
  </div>

  <button type="submit" class="btn btn-primary" id="btnSubmit" name="modifApporter">Ajouter les
    modifications</button>
</form>
<?php
} else {
?>
<h1 style=" padding-left: 10rem; padding-right: 35rem; padding-top: 10rem; color: #f0f0f0;">Le mot de passe a été
  modifier avec succès.</h1>
<div style="padding-left: 10rem; padding-right: 30rem">
  <a class="btn btn-primary" style="width: 10%;" href="gestionProfil.php" role="button">
    <h4>Retour</h4>
  </a>
</div>
<?php
}
?>
<script>
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$("#frmSaisi").on("submit", function() {
  return isValidForm();
})

function isValidForm() {
  let binErreur = false;
  $(".erreur").remove();
  if (!validationMotDePasse($("#password1").val())) {
    $("#password1").after("<div class='erreur'><p style='color:red'>*Le mot de passe n'est pas valide</p></div>");
    binErreur = true;
  }
  if ($("#password2").val() != $("#password1").val()) {
    $("#password2").after(
      "<div class='erreur'><p style='color:red'>*Les mots de passes douvent être identique</p></div>");
    binErreur = true;
  }

  if (binErreur) return false;
  return true;
}
</script>
</body>

</html>