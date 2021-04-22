<?php

$binAffichageAnnonce = false;

require_once("barreNavigation.php");
require_once("libValidation.php");

// $intNoEmpl = isset($_POST["numeroEmpl"]) ? $_POST["numeroEmpl"] : null;
// var_dump($intNoEmpl);
// if ($intNoEmpl != null) {
//   $sql = "SELECT * FROM utilisateurs WHERE NoEmpl = :NoEmpl";
//   $query = $mysql->cBD->prepare($sql);
//   $query->bindValue(':NoEmpl', $intNoEmpl, PDO::PARAM_INT);
//   $query->execute();
//   $result = $query->fetchAll(PDO::FETCH_BOTH);
//   if (count($result) == 0) {
//     echo false;
//   } else {
//     echo true;
//   }
// } else {
//   echo false;
// }

$strNumUtil = "2";

if (!isset($_POST['modifApporter'])) {
  $sql = 'SELECT * FROM utilisateurs WHERE NoUtilisateur=:id';
  $query = $mysql->cBD->prepare($sql);
  $query->bindValue(':id', $strNumUtil, PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  foreach ($result as $user) {
    $strNom = $user['Nom'];
    $strPrenom = $user['Prenom'];
    $strEmail = $user['Courriel'];
    $strTelMaison = substr($user['NoTelMaison'], 0, strlen($user['NoTelMaison']) - 1);
    $strTelMaisonCheck = substr($user['NoTelMaison'], strlen($user['NoTelMaison']) - 1);
    $strTelTravail = substr($user['NoTelTravail'], 0, strlen($user['NoTelTravail']) - 1);
    $strTelTravailCheck = substr($user['NoTelTravail'], strlen($user['NoTelTravail']) - 1);
    $strTelCellulaire = substr($user['NoTelCellulaire'], 0, strlen($user['NoTelCellulaire']) - 1);
    $strTelCellulaireCheck = substr($user['NoTelCellulaire'], strlen($user['NoTelCellulaire']) - 1);
    $strStatut = $user['Statut'];
    $strNoEmpl = $user['NoEmpl'];
    $strCouleur = $user['CouleurProfil'];

    // Verifier si chaque telephone est public ou non
    if ($strTelMaisonCheck == "P") $strCheckMaison = "Checked";
    else $strCheckMaison = "";
    if ($strTelCellulaireCheck == "P") $strCheckCellulaire = "Checked";
    else $strCheckCellulaire = "";
    if ($strTelTravailCheck == "P") $strCheckTravail = "Checked";
    else $strCheckTravail = "";
  }
} else {
  $strNom = parametre("nom");
  $strPrenom = parametre("prenom");
  $strEmail = parametre("email");
  $strTelMaison = parametre("telMaison");
  if (parametre("checkMaison") == "on") $strTelMaison .= "P";
  else $strTelMaison .= "N";
  $strTelTravail = parametre("telTravail");
  if (parametre("checkTravail") == "on") $strTelTravail .= "P";
  else $strTelTravail .= "N";
  $strTelCellulaire = parametre("telCellulaire");
  if (parametre("checkCellulaire") == "on") $strTelCellulaire .= "P";
  else $strTelCellulaire .= "N";
  $strStatut = parametre("statut");
  $strNoEmpl = parametre("numeroEmpl");
  $strCouleur = parametre("primary-color");

  try {
    $sql = 'UPDATE utilisateurs SET Nom=?, Prenom=?, Courriel=?, NoTelMaison=?, NoTelTravail=?, NoTelCellulaire=?, Statut=?, NoEmpl=?, CouleurProfil=? WHERE NoUtilisateur=?';
    $query = $mysql->cBD->prepare($sql)->execute([$strNom, $strPrenom, $strEmail, $strTelMaison, $strTelTravail, $strTelCellulaire, $strStatut, $strNoEmpl, $strCouleur, $strNumUtil]);
  } catch (Exception $e) {
    die("Erreur dans la requete!");
  }
}

if (!isset($_POST['modifApporter'])) {
?>
<form class=" frmModificationProfil" id="frmSaisi" method="POST" action="gestionProfil.php" style="margin-top: 30px">
  <div class="imgProfil">
    <label id="test_wrapper" style="background:<?= $strCouleur ?>">
      <div>
        <div class="colText">Clicker sur la couleur pour changer votre
          couleur de profil</div>
        <input type="color" id="primary_color" class="field-radio" name="primary-color" value="<?= $strCouleur ?>">
      </div>
    </label>
  </div>
  <div id="divinscription" class="row mb-5">
    <div class="col-sm-8">
      <h1 class="headerProfil">Modifier votre profil</h1>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputNom" class="col-sm-3 col-form-label">Nom de famille</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputNom" name="nom" value="<?= $strNom ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPrenom" class="col-sm-3 col-form-label">Prénom</label>
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
      <input class="telCheck" type="checkbox" id="gridCheckMaison" name="checkMaison" <?= $strCheckMaison ?>>
      <label class="telCheck" for="gridCheckMaison">
        Rendre cette information public lors de l'affichage d'annonce?
      </label>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputTeleTravail" class="col-sm-4 col-form-label">Téléphone (poste) au travail
      <br />(facultatif)</label>
    <div class="col-sm-7">
      <input type="text" class="form-control inputFields" id="inputTeleTravail" name="telTravail"
        value="<?= $strTelTravail ?>">
      <input class="telCheck" type="checkbox" id="gridCheckTravail" name="checkTravail" <?= $strCheckTravail ?>>
      <label class="telCheck" for="gridCheckTravail">
        Rendre cette information public lors de l'affichage d'annonce?
      </label>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputCellulaire" class="col-sm-3 col-form-label">Téléphone cellulaire <br />(facultatif)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputCellulaire" name="telCellulaire"
        value="<?= $strTelCellulaire ?>">
      <input class="telCheck" type="checkbox" id="gridCheckCellulaire" name="checkCellulaire"
        <?= $strCheckCellulaire ?>>
      <label class="telCheck" for="gridCheckCellulaire">
        Rendre cette information public lors de l'affichage d'annonce?
      </label>
    </div>
  </div>
  <div class="row mb-3">
    <label for="selectStatut" class="col-sm-3 col-form-label">Statut de l'employé (facultatif)</label>
    <div class="col-sm-8">
      <?php
        // Ajuster le statut de l'employer pour celui dans la base de donnee
        $select9 = $select2 = $select3 = $select4 = $select5 = "";
        switch ($strStatut) {
          case '9':
            $select9 = "selected";
            break;
          case '2':
            $select2 = "selected";
            break;
          case '3':
            $select3 = "selected";
            break;
          case '4':
            $select4 = "selected";
            break;
          case '5':
            $select5 = "selected";
            break;
        }
        ?>
      <select id="idStatut" class="form-select inputFields" name=statut>
        <option value="9" <?= $select9 ?>>Confirmé</option>
        <option value="2" <?= $select2 ?>>Cadre</option>
        <option value="3" <?= $select3 ?>>Employé de soutien</option>
        <option value="4" <?= $select4 ?>>Enseigant</option>
        <option value="5" <?= $select5 ?>>Professionnel</option>
      </select>
    </div>
  </div>
  <div class="row mb-3">
    <label for="numeroEmpl" class="col-sm-3 col-form-label">Numéro de l'employé (facultatif)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="numeroEmpl" name="numeroEmpl" value="<?= $strNoEmpl ?>">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" id="btnSubmit" name="modifApporter">Ajouter les
    modifications</button>
</form>
<?php
} else {
?>
<h1 style=" padding-left: 10rem; padding-right: 35rem; padding-top: 10rem; color: #f0f0f0;">Les modifications sur
  votre profil ont été ajoutées avec succès.</h1>
<div style="padding-left: 10rem; padding-right: 30rem">
  <a class="btn btn-primary" style="width: 10%;" href="gestionProfil.php" role="button">
    <h4>Retour</h4>
  </a>
</div>
<?php
}
?>
<script>
$(document).ready(function() {
  $("#primary_color").change(function() {
    $("#test_wrapper").css("background", $("#primary_color").val())
  })
});

if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$("#frmSaisi").on("submit", function() {
  return isValidForm();
})

function isValidForm() {
  let binErreur = false;
  $("#erreur").remove();
  if (!validationEmail($("#inputCourriel").val())) {
    $("#inputCourriel").after("<div id='erreur'><p style='color:red'>*Le courriel n'est pas valide</p></div>");
    binErreur = true;
  }
  if (emailExiste($("#inputCourriel").val()) && $("#inputCourriel").val() != "<?= $strEmail; ?>") {
    $("#inputCourriel").after("<div id='erreur'><p style='color:red'>*Le courriel est déjà utilisé</p></div>");
    binErreur = true;
  }
  if (!validationNomPrenom($("#inputNom").val())) {
    $("#inputNom").after(
      "<div id='erreur'><p style='color:red'>*Votre nom contient des charactère non valide</p></div>");
    binErreur = true;
  }
  if (!validationNomPrenom($("#inputPrenom").val())) {
    $("#inputPrenom").after(
      "<div id='erreur'><p style='color:red'>*Votre prenom contient des charactère non valide</p></div>");
    binErreur = true;
  }
  if (!validationTelMaisonCellulaire($("#inputTeleMaison").val())) {
    $("#inputTeleMaison").after(
      "<div id='erreur'><p style='color:red'>*Le numero de téléphone doit être dans le format (999) 999-9999</p></div>"
    );
    binErreur = true;
  }
  if (!validationTelMaisonCellulaire($("#inputCellulaire").val())) {
    $("#inputCellulaire").after(
      "<div id='erreur'><p style='color:red'>*Le numero de téléphone doit être dans le format (999) 999-9999</p></div>"
    );
    binErreur = true;
  }
  if (!validationTelTravail($("#inputTeleTravail").val())) {
    $("#inputTeleTravail").after(
      "<div id='erreur'><p style='color:red'>*Le numero de téléphone doit être dans le format (999) 999-9999 #9999</p></div>"
    );
    binErreur = true;
  }
  if (noEmployeExiste($("#numeroEmpl").val()) /*&& $("#numeroEmpl").val() != "<?= $strNoEmpl; ?>"*/ ) {
    $("#numeroEmpl").after("<div id='erreur'><p style='color:red'>*Ce numéro d'employé existe déjà</p></div>");
    binErreur = true;
  }

  if (binErreur) return false;
  return true;
}
</script>
</body>

</html>