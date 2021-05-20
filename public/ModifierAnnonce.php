<?php
$binAffichageAnnonce = false;
require_once("barreNavigation.php");

$intNoAnnonce = parametre("idAnnonce");
$sql = 'SELECT * FROM categories';
$query = $mysql->cBD->prepare($sql);
$query->execute();
$tCategorie = $query->fetchAll(PDO::FETCH_BOTH);


//Ajout des Annonces dans la DB
$strDescriptionAbregee = parametre('descriptionAbregee');
$strDescriptionComplete = parametre("descriptionComplete");
$intNoCategorie = parametre("Categorie");
$fltPrix = parametre("prix");
$intEtat = parametre("Etat");
$strImage = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : null;

$strMessage = "";
$strCouleurMessage = "text-success";

if ($strDescriptionAbregee != null && $strDescriptionComplete != null && $intNoCategorie != null && $fltPrix != null && $intEtat != null) {
    $sql = 'UPDATE annonces SET Categorie=?,DescriptionAbregee=?,DescriptionComplete=?,Prix=?,Etat=?,MiseAJour=CURRENT_TIMESTAMP WHERE NoAnnonce=?';
    $query = $mysql->cBD->prepare($sql);
    if ($query->execute([$intNoCategorie, $strDescriptionAbregee, $strDescriptionComplete, $fltPrix, $intEtat, $intNoAnnonce])) {
        if ($strImage != null) {
            $strImage = "imgAnnonce" . $intNoAnnonce . "." . pathinfo($_FILES["image"]["name"])['extension'];

            $sql = 'UPDATE annonces SET Photo=? WHERE NoAnnonce=?';
            $query = $mysql->cBD->prepare($sql);
            $query->execute(["/photos-annonce/$strImage", $intNoAnnonce]);

            $imagePath = "../photos-annonce/$strImage";
            if (!file_exists($strImage)) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
            }
        }
        $strMessage = "Votre annonce a bien été modifier.";
    } else {
        $strMessage = "La modification de cette annonce n'a pas pu être effectuer";
        $strCouleurMessage = "text-danger";
    }
}

$sql = 'SELECT * FROM annonces WHERE NoAnnonce=?';
$query = $mysql->cBD->prepare($sql);
$query->execute([$intNoAnnonce]);
$tAnnonce = $query->fetchAll(PDO::FETCH_BOTH)[0];
?>
<div class="container boxAjouterAnnonce col-xl-8 col-sm-10 col-12 py-4 px-5 mt-4 mb-3">
  <h3 class="headerProfil pb-5 text-center">Modification de votre annonce</h3>
  <p class="text-center <?= $strCouleurMessage ?>" id="message"><?= $strMessage ?></p>
  <form class="form-inline" id="idFormModifierAnnonce" action="ModifierAnnonce.php" method="post"
    enctype="multipart/form-data">
    <input type="hidden" name="idAnnonce" value="<?= $tAnnonce["NoAnnonce"] ?>">
    <div class="form-group pb-3">
      <label class="col-form-label" for="idDescriptionAbregee">Description abrégée: </label>
      <input type="text" class="form-control" maxlength="50" id="idDescriptionAbregee" name="descriptionAbregee"
        value="<?= $tAnnonce["DescriptionAbregee"] ?>">
      <span class="invalid-feedback text-center" id="messageInvalideDescriptionAbregee"></span>
    </div>

    <div class="form-group py-3">
      <label class="col-form-label" for="idDescriptionComplete">Description complète: </label>
      <textarea type="text" height="3" rows="3" class="form-control" maxlength="250" id="idDescriptionComplete"
        name="descriptionComplete"><?= $tAnnonce["DescriptionComplete"] ?></textarea>
      <span class="invalid-feedback text-center" id="messageInvalideDescriptionComplete"></span>
    </div>

    <div class="form-group col-xl-5 col-sm-12 pb-2">
      <label class="col-form-label" for="idCategorie">Choisir une catégorie: </label>
      <select class="form-select" name="Categorie" id="idCategorie">
        <option value=""></option>
        <?php for ($i = 0; $i < count($tCategorie); $i++) { ?>
        <?php if ($tCategorie[$i]["NoCategorie"] == $tAnnonce["Categorie"]) { ?>
        <option value="<?= $tCategorie[$i]["NoCategorie"] ?>" selected><?= $tCategorie[$i]["Description"] ?></option>
        <?php } else { ?>
        <option value="<?= $tCategorie[$i]["NoCategorie"] ?>"><?= $tCategorie[$i]["Description"] ?></option>
        <?php }
                } ?>
      </select>
      <span class="invalid-feedback text-center" id="messageInvalideCategorie"></span>
    </div>

    <div class="form-group col-xl-4 col-sm-12 py-3">
      <label class="col-form-label" for="idPrix">Prix: </label>
      <div class="input-group has-validation">
        <input type="text" class="form-control" id="idPrix" name="prix" value="<?= $tAnnonce["Prix"] ?>">
        <span class="input-group-text">$</span>
        <span class="invalid-feedback text-center" id="messageInvalidePrix"></span>
      </div>
    </div>

    <div class="form-group col-xl-3 col-sm-10 pb-2">
      <label class="col-form-label" for="idEtat">État: </label>
      <select class="form-select" name="Etat" id="idEtat">
        <option value="1" <?= $tAnnonce["Etat"] == 1 ? "selected" : "" ?>>Actif</option>
        <option value="2" <?= $tAnnonce["Etat"] == 2 ? "selected" : "" ?>>Inactif</option>
      </select>
      <span class="invalid-feedback text-center" id="messageInvalideEtat"></span>
    </div>

    <div class="form-group col-xl-7 col-sm-12 py-3">
      <label class="col-form-label" for="idImage">Image: </label>
      <input type="file" class="form-control" id="idImage" name="image" accept="image/*"
        onchange="montrerImage(event)" />
      <img style='height: 40%; width: 100%; object-fit: contain' src="../<?= $tAnnonce["Photo"] ?>"
        class="img-thumbnail mt-4" id="idMontrerImage">
      <span class="invalid-feedback text-center" id="messageInvalideImage"></span>
    </div>

    <div class="form-group col-xl-12 col-sm-12 mt-4 row justify-content-center">
      <hr />
      <input type="button" class="btn btn1 me-3 mt-3 col-xl-4 col-sm-6" id="btnModifier"
        value="Modifier votre annonce" />
      <input type="button" class="btn btn2 mt-3 col-xl-3 col-sm-5" id="btnAnnuler" value="Annuler"
        onclick="location.href = 'gestionAnnonce.php'" />
    </div>
  </form>
</div>

<script>
function montrerImage(event) {
  if (event.target.files.length > 0) {
    if (event.target.files[0]['type'].split('/')[0] === 'image') {
      let src = URL.createObjectURL(event.target.files[0]);
      document.getElementById('idMontrerImage').src = src;
      document.getElementById('idImage').classList.remove('is-invalid');
    } else {
      document.getElementById('idImage').classList.add('is-invalid');
      document.getElementById('messageInvalideImage').innerHTML = "Le fichier entrer n'est pas une image";
      document.getElementById('idMontrerImage').src = '../photos-annonce/default.jpg';
      document.getElementById('idImage').value = null;
    }
  }
}

// Validation
$(document).ready(function() {
  $('#btnModifier').click(function() {
    let binValider = true;

    if ($('#idDescriptionAbregee').val().trim() == '') {
      binValider = false;
      $('#idDescriptionAbregee').addClass('is-invalid');
      $('#messageInvalideDescriptionAbregee').html("Vous devez remplir ce champ");
    } else {
      $('#idDescriptionAbregee').removeClass('is-invalid');
    }

    if ($('#idDescriptionComplete').val().trim() == '') {
      binValider = false;
      $('#idDescriptionComplete').addClass('is-invalid');
      $('#messageInvalideDescriptionComplete').html("Vous devez remplir ce champ");
    } else {
      $('#idDescriptionComplete').removeClass('is-invalid');
    }

    if ($('#idCategorie').val().trim() == '') {
      binValider = false;
      $('#idCategorie').addClass('is-invalid');
      $('#messageInvalideCategorie').html("Vous devez sélectionner une catégorie");
    } else {
      $('#idCategorie').removeClass('is-invalid');
    }

    if (!validerPrix($('#idPrix').val())) {
      binValider = false;
      $('#idPrix').addClass('is-invalid');
      $('#messageInvalidePrix').html("Le prix entrer est invalid");
    } else {
      $('#idPrix').removeClass('is-invalid');
    }

    if ($('#idMontrerImage').attr('src') == '../photos-annonce/default.jpg') {
      binValider = false;
      $('#idImage').addClass('is-invalid');
      $('#messageInvalideImage').html("Veuillez entrer une image pour votre annonce");
    } else {
      $('#idImage').removeClass('is-invalid');
    }

    if (binValider) {
      $("#idFormModifierAnnonce").submit();
    }
  });
});
</script>

</body>

</html>