<?php
    $binAffichageAnnonce = false;
    require_once("barreNavigation.php");
    $noUtilisateur = parametre("noUtilisateur");

?>

<div class="container boxAjouterAnnonce col-xl-10 col-12 pt-3 px-5 mt-3">
    <h2 class="text-center headerProfil" id="idTitreContact" >Contact</h2>

    <form class="form-group row" id="idEnvoyerUnMessage" method="POST" action="Contact.php">
        <div class="col-6 p-2">
            <input type="text" class="form-control" id="idNom" placeholder="Nom" name="nom">
            <span class="invalid-feedback text-center">Veuillez entrer votre nom</span>
        </div>
        <div class="col-6 p-2">
            <input type="email" class="form-control" id="idEmail" placeholder="Email" name="email">
            <span class="invalid-feedback text-center">Veuillez entrer votre email</span>
        </div>
        <div class="col-12 p-2">
            <textarea class="form-control " placeholder="Entrer votre message" id="idMessage" rows="15" name="message"></textarea>
            <span class="invalid-feedback text-center">Veuillez entrer un message</span>
        </div>
        <div class="col-12 py-4">
            <input type="button" class="btn btn1 col-12" id="btnEnvoyer" value="Envoyer"/>
        </div>
    </from>
</div>

<script>
// Validation
$(document).ready(function () {
    
    $('#btnEnvoyer').click(function () {
        let $binValider = true;
        if ($('#idNom').val().trim() == ''){
            $binValider = false;
            $('#idNom').addClass('is-invalid');
        }
        else {
            $('#idNom').removeClass('is-invalid');
            $('#idNom').addClass('is-valid');
        }

        if ($('#idEmail').val().trim() == ''){
            $binValider = false;
            $('#idEmail').addClass('is-invalid');
        }
        else {
            $('#idEmail').removeClass('is-invalid');
            $('#idEmail').addClass('is-valid');
        }

        if ($('#idMessage').val().trim() == ''){
            $binValider = false;
            $('#idMessage').addClass('is-invalid');
        }
        else {
            $('#idMessage').removeClass('is-invalid');
            $('#idMessage').addClass('is-valid');
        }

        if ($binValider){
            $('#idEnvoyerUnMessage').submit();
        }
    }); 
});