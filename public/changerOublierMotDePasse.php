<?php
function parametre($strIDParam, $binGet = false)
{
  return !$binGet ? (isset($_POST[$strIDParam]) ? ($_POST[$strIDParam] == '' ? null : $_POST[$strIDParam]) : null) : (isset($_GET[$strIDParam]) ? ($_GET[$strIDParam] == '' ? null : $_GET[$strIDParam]) : null);
}
require_once("classe-mysql.php");

$strInfosSensibles = "../dbconfig.php";
$mysql = new mysql($strInfosSensibles);

$strPassword = parametre("password1");
if (isset($_GET["id"])) $strNumUtil = base64_decode($_GET["id"]);
$strNumUser = parametre("idUtil");

if (isset($_POST['modifApporter'])) {
  try {
    $sql = 'UPDATE utilisateurs SET MotDePasse=? WHERE NoUtilisateur=?';
    $query = $mysql->cBD->prepare($sql)->execute([$strPassword, $strNumUser]);
  } catch (Exception $e) {
    die("Erreur dans la requete!");
  }
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
  <link rel="stylesheet" type="text/css" href="slideNav.css">

  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
  <?php

  if (!isset($_POST['modifApporter'])) {
  ?>
  <form class="frmModificationProfil" id="frmSaisi" method="POST" action="changerOublierMotDePasse.php"
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
    <input type="hidden" id="id" name="idUtil" value="<?= $strNumUtil ?>">
    <button type="submit" class="btn btn-primary" id="btnSubmit" name="modifApporter">Ajouter les
      modifications</button>
  </form>
  <?php
  } else {
  ?>
  <h1 style=" padding-left: 10rem; padding-right: 35rem; padding-top: 10rem; color: #f0f0f0;">Le mot de passe a été
    modifier avec succès.</h1>
  <div style="padding-left: 10rem; padding-right: 30rem">
    <a class="btn btn-primary" style="width: 10%;" href="connexion.php" role="button">
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