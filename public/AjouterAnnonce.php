<?php
    $binAffichageAnnonce = false;
    require_once("barreNavigation.php");
    
    $sql = 'SELECT * FROM categories';
    $query = $mysql->cBD->prepare($sql);
    $query->execute();
    $tCategorie = $query->fetchAll(PDO::FETCH_BOTH);
?>
    <div class="container boxAjouterAnnonce col-xl-8 col-sm-10 col-12 py-4 px-5 my-5">
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
                <div class="input-group">
                    <input type="text" class="form-control" id="idPrix" name="prix">
                    <span class="input-group-text">$</span>
                </div>
                <span class="invalid-feedback text-center" id="messageInvalidePrix"></span>
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

        </form>
    </div>
    <script>
        function montrerImage(event){
            if (event.target.files.length > 0){
                let src = URL.createObjectURL(event.target.files[0]);
                document.getElementById('idMontrerImage').src = src;
            }
        }
    </script>
    </body>
</html>