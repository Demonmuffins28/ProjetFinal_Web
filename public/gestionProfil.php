<?php
require_once("barreNavigation.php");
?>

<div class="imgProfil">
  <img src="../images/profil1.jpg" width="350" height="350" class="rounded-circle shadow-sm row" />
  <input class="row btnImgProfil" type="file" id=changeProfil name="changeProfil" accept="../images/*">
</div>

<form class="frmModificationProfil" method="get" action="" style="margin-top: 30px">
  <!-- Inscription -->
  <div id="divinscription" class="row mb-5">
    <div class="col-sm-8">
      <h1 class="headerProfil">Modifier votre profil</h1>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputNom" class="col-sm-3 col-form-label">Nom</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputNom">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPrenom" class="col-sm-3 col-form-label">Prenom</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputPrenom">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputCourriel" class="col-sm-3 col-form-label">Courriel</label>
    <div class="col-sm-8">
      <input type="email" class="form-control inputFields" id="inputCourriel">
    </div>
  </div>
  <div class="row mb-3">
    <label for="profChangPass" class="col-sm-3 col-form-label">Mot de passe</label>
    <div class="col-sm-8">
      <button type="submit" class="btn inputFields btnPass">Clicker pour changer votre mot de passe?</button>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputTeleMaison" class="col-sm-3 col-form-label">Téléphone à la maison
      <br />(facultatif)
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputTeleMaison">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputTeleTravail" class="col-sm-4 col-form-label">Téléphone (poste) au travail
      <br />(facultatif)</label>
    <div class="col-sm-7">
      <input type="text" class="form-control inputFields" id="inputTeleTravail">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputCellulaire" class="col-sm-3 col-form-label">Téléphone cellulaire <br />(facultatif)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="inputCellulaire">
    </div>
  </div>
  <div class="row mb-3">
    <label for="selectStatut" class="col-sm-3 col-form-label">Status de l'utilisateur</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="selectStatut" disabled placeholder="En attente">
    </div>
  </div>
  <div class="row mb-3">
    <label for="affichageNumUtil" class="col-sm-3 col-form-label">Numéro de l'utilisateur</label>
    <div class="col-sm-8">
      <input type="text" class="form-control inputFields" id="affichageNumUtil" disabled placeholder="999">
    </div>
  </div>
  <div class="col-sm-10">
    <div class="form-check col-sm-10">
      <input class="form-check-input " type="checkbox" id="gridCheck">
      <label class="col-form-label" for="gridCheck">
        Rendre vos information public lors de l'affichage d'annonce?
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Ajouter les modifications</button>
</form>

</body>

</html>