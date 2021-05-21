<?php

if (isset($_GET["etat"]) && isset($_GET["idAnnonce"])) {
  require_once("classe-mysql.php");
  $strInfosSensibles = "../dbconfig.php";
  $mysql = new mysql($strInfosSensibles);

  $sql = 'UPDATE annonces SET Etat=3 WHERE NoAnnonce=' . $_GET["idAnnonce"];
  $query = $mysql->cBD->prepare($sql);
  $query->execute();

  header("Location: gestionAnnonce.php");
} else {

  require_once("annonceDetaille.php");

?>

<!-- Modal -->
<div class="modal fade text-dark" id="supprimerAnnonce" tabindex="-1" aria-labelledby="supprimerAnnonceLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supprimerAnnonceLabel">Supprimer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          onclick="toggleModal()"></button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer l'annonce suivante? </br>
        <b><?= $titre ?></b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mt-0" data-bs-dismiss="modal"
          onclick="toggleModal()">Annuler</button>
        <a href="retirerAnnonce.php?etat=3&idAnnonce=<?= $strAnnonce ?>" type="button"
          class="btn btn-danger mt-0">Supprimer</a>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
  toggleModal()
})

function toggleModal() {
  $('#supprimerAnnonce').modal('toggle')
}
</script>
<?php
}
?>