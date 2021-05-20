<?php
    $binAffichageAnnonce = false;
    require_once("barreNavigation.php");
    $noUtilisateur = parametre("noUtilisateur");
    $strTitre = parametre("titre");
    $strPrix = parametre("prix");

    $sql = "SELECT * FROM utilisateurs WHERE NoUtilisateur=$noUtilisateur";
    $query = $mysql->cBD->prepare($sql);
    $query->execute();
    $tUtilisateur = $query->fetchAll(PDO::FETCH_ASSOC)[0];

?>
        <div class="container boxAjouterAnnonce col-xl-10 col-12 pt-3 px-5 mt-3">
            <h2 class="text-center headerProfil mb-4" id="idTitreContact">Contacter <?= $tUtilisateur["Prenom"] . " " . $tUtilisateur["Nom"] ?></h2>
            <p class="text-center text-success" id="confirmation">Votre message à bien été envoyé</p>
            <input type="hidden" id="email" value="<?= $tUtilisateur["Courriel"] ?>">
            <input type="hidden" id="titreAnnonce" value="<?= $strTitre . " (" . $strPrix . ")" ?>">
            <div class="col-12 p-2">
                <label class="headerProfil fw-bold fs-5 text-center"><?= "Pour l'annonce: " . $strTitre . " (" . $strPrix . ")" ?></label>
            </div>
            <div class="col-12 p-2">
                <textarea class="form-control " placeholder="Entrer votre message" id="idMessage" rows="15" name="message"></textarea>
                <span class="invalid-feedback text-center">Veuillez entrer un message</span>
            </div>
            <div class="col-12 py-4 align-items-center d-flex justify-content-center">
                <input type="button" class="btn btn1 me-3 mt-3 col-xl-4 col-sm-6" id="btnEnvoyer" value="Envoyer" />
                <input type="button" class="btn btn2 mt-3 col-xl-4 col-sm-5" id="btnAnnuler" value="Annuler" onclick="location.href = 'menuPrincipale.php'"/>
            </div>
        </div>

        <script>
            // Validation
            $(document).ready(function() {
                $('#confirmation').hide();
                $('#btnEnvoyer').click(function() {
                    $('#confirmation').hide();
                    let $binValider = true;
                    if ($('#idMessage').val().trim() == '') {
                        $binValider = false;
                        $('#idMessage').addClass('is-invalid');
                    } else {
                        $('#idMessage').removeClass('is-invalid');
                        $('#idMessage').addClass('is-valid');
                    }
                    if ($binValider) {
                        $.post('EnvoyerEmailContact.php', {email: $('#email').val(), message: $('#idMessage').val(), titre: $('#titreAnnonce').val()});
                        $('#idMessage').removeClass('is-valid');
                        $('#idMessage').val("");
                        $('#confirmation').show();
                    }
                });
            });
        </script>
    </body>
</html>