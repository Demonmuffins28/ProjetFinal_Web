<?php
$binAffichageAnnonce = false;
require_once("annonceDetaille.php");

?>

<!-- Modal -->
<div class="modal fade text-dark" id="supprimerAnnonce" tabindex="-1" aria-labelledby="supprimerAnnonceLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supprimerAnnonceLabel">Supprimer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Êtes-vous sûr de vouloir supprimer l'annonce suivante? </br>
       <b><?=$titre?></b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mt-0" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger mt-0">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#supprimerAnnonce').modal('show');

  var myModal = document.getElementById('myModal')
  var myInput = document.getElementById('myInput')

  myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
  })
</script>