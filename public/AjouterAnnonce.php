<?php
    $binAffichageAnnonce = false;
    require_once("barreNavigation.php");
    
    $sql = 'SELECT * FROM categories';
    $query = $mysql->cBD->prepare($sql);
    $query->execute();
    $tCategorie = $query->fetchAll(PDO::FETCH_BOTH);
?>
    <div class="container boxAjouterAnnonce col-xl-8 col-sm-10 col-12 py-4 px-5 mt-4 mb-3">
        <h3 class="headerProfil pb-5 text-center">Ajouter une annonce</h3>
        <form class="form-inline" action="EnregistrerAnnonces.php" method="post">

            <div class="form-group pb-3">
                <label class="col-form-label" for="idDescriptionAbregee">Description abrégée: </label>
                <input type="text" class="form-control" maxlength="50" id="idDescriptionAbregee" name="descriptionAbregee">
                <span class="invalid-feedback text-center" id="messageInvalideDescriptionAbregee"></span>
            </div>

            <div class="form-group py-3">
                <label class="col-form-label" for="idDescriptionComplete">Description complète: </label>
                <textarea type="text" height="3" rows="3" class="form-control" maxlength="250" id="idDescriptionComplete" name="descriptionComplete"></textarea>
                <span class="invalid-feedback text-center" id="messageInvalideDescriptionComplete"></span>
            </div>

            <div class="form-group col-xl-5 col-sm-12 pb-2">
                <label class="col-form-label" for="idCategorie">Choisir une catégorie: </label>
                <select class="form-select" name="Categorie" id="idCategorie">
                    <option value=""></option>
                    <?php for ($i=0; $i<count($tCategorie); $i++){?>
                        <option value="<?=$tCategorie[$i]["NoCategorie"]?>"><?=$tCategorie[$i]["Description"]?></option>
                    <?php }?>
                </select>
                <span class="invalid-feedback text-center" id="messageInvalideCategorie"></span>
            </div>

            <div class="form-group col-xl-4 col-sm-12 py-3">
                <label class="col-form-label" for="idPrix">Prix: </label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" id="idPrix" name="prix">
                    <span class="input-group-text">$</span>
                    <span class="invalid-feedback text-center" id="messageInvalidePrix"></span>
                </div>
            </div>

            <div class="form-group col-xl-3 col-sm-10 pb-2">
                <label class="col-form-label" for="idEtat">État: </label>
                <select class="form-select" name="Etat" id="idEtat">
                    <option value="1">Actif</option>
                    <option value="2">Inactif</option>
                </select>
                <span class="invalid-feedback text-center" id="messageInvalideEtat"></span>
            </div>

            <div class="form-group col-xl-7 col-sm-12 py-3">
                <label class="col-form-label" for="idImage">Image: </label>
                <input type="file" class="form-control" id="idImage" name="image" accept="image/*"  onchange="montrerImage(event)"/>
                <img style='height: 40%; width: 100%; object-fit: contain' src="../photos-annonce/default.jpg" class="img-thumbnail mt-4" id="idMontrerImage">              
                <span class="invalid-feedback text-center" id="messageInvalideImage"></span>
            </div>
            
            <div class="form-group col-xl-12 col-sm-12 mt-4 row justify-content-center">
                <hr/>
                <input type="button" class="btn btn1 me-3 mt-3 col-xl-4 col-sm-6" id="btnPoster" value="Poster votre annonce" />
                <input type="button" class="btn btn2 mt-3 col-xl-3 col-sm-5" id="btnAnnuler" value="Annuler" onclick="location.href = 'gestionAnnonce.php'"/>
            </div>
        </form>
    </div>

    <script>

        function montrerImage(event){
            if (event.target.files.length > 0){
                if (event.target.files[0]['type'].split('/')[0] === 'image'){
                    let src = URL.createObjectURL(event.target.files[0]);
                    document.getElementById('idMontrerImage').src = src;
                    document.getElementById('idImage').classList.remove('is-invalid');
                }
                else{
                    document.getElementById('idImage').classList.add('is-invalid');
                    document.getElementById('messageInvalideImage').innerHTML = "Le fichier entrer n'est pas une image";
                    document.getElementById('idMontrerImage').src = '../photos-annonce/default.jpg';
                    document.getElementById('idImage').value = null;
                }
            }
        }

        // Validation
        $(document).ready(function () {
            $('#btnPoster').click(function () {
                let binValider = true;

                if ($('#idDescriptionAbregee').val().trim() == ''){
                    binValider = false;
                    $('#idDescriptionAbregee').addClass('is-invalid');
                    $('#messageInvalideDescriptionAbregee').html("Vous devez remplir ce champ");
                }else {$('#idDescriptionAbregee').removeClass('is-invalid');}

                if ($('#idDescriptionComplete').val().trim() == ''){
                    binValider = false;
                    $('#idDescriptionComplete').addClass('is-invalid');
                    $('#messageInvalideDescriptionComplete').html("Vous devez remplir ce champ");
                }else {$('#idDescriptionComplete').removeClass('is-invalid');}

                if ($('#idCategorie').val().trim() == ''){
                    binValider = false;
                    $('#idCategorie').addClass('is-invalid');
                    $('#messageInvalideCategorie').html("Vous devez sélectionner une catégorie");
                }else {$('#idCategorie').removeClass('is-invalid');}

                if (!validerPrix($('#idPrix').val())){
                    binValider = false;
                    $('#idPrix').addClass('is-invalid');
                    $('#messageInvalidePrix').html("Le prix entrer est invalid");
                }else {$('#idPrix').removeClass('is-invalid');}

                if ($('#idImage').val() == ''){
                    binValider = false;
                    $('#idImage').addClass('is-invalid');
                    $('#messageInvalideImage').html("Veuillez entrer une image pour votre annonce");
                }else {$('#idImage').removeClass('is-invalid');}

                if (binValider){

                }
            });
        });

    </script>

    </body>
</html>