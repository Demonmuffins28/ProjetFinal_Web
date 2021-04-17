<?php
    require_once("accueil.php");

    //Recupérer l'adresse courriel de la requete post
    $strEmail = isset($_POST["email"]) ? $_POST["email"] : null;
    //Regarder si elle existe
    //Si oui, envoyé un courriel a cette adresse avec le mot de passe
    //Si non, envoyé un message indiquant l'adresse indiqué n'existe pas

?>

<div class="col-7 h-100">

                    <!-- Bouton retour -->
                    <div class="d-flex justify-content-end p-5">
                        <a class="btn btn-primary" style="width: 20%;" href="connexion.php" role="button"><h4>Retour</h4></a>
                    </div>

                    <form class="d-flex flex-column justify-content-start align-items-center h-75 w-100" id="idMotDePasseOublier" method="POST" action="oublierMotDePasse.php">

                        <div class="form-group col-6 p-4">
                            <label><h1>Mot de passe oublié</h1></label>
                        </div>

                        <div class="form-group has-feedback col-6 p-4">
                            <label><h5>Veuillez entrer votre adresse de courriel ci-dessous et nous vous enverrons un courriel pour recupérer votre mot de passe.</h5></label>
                        </div>

                        <!-- Adresse de courriel -->
                        <div class="form-group has-feedback col-6 p-4">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Adresse courriel" style="font-size : 20px; "/>
                        </div>

                        <!-- Bouton envoyer un courriel -->
                        <div class="form-group col-6 p-4">
                            <input type="submit" id="btnConnexion" class="btn btn-primary btn-block w-100" value="Envoyer un courriel" style="font-size : 30px; font-weigth" />
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>