<?php 

require_once("accueil.php");
?>

                <div class="col-7 h-100">

                    <!-- Bouton retour -->
                    <div class="d-flex justify-content-end p-5">
                        <a class="btn btn-primary" style="width: 20%;" href="connexion.php" role="button"><h4>Retour</h4></a>
                    </div>

                    <form class="d-flex flex-column justify-content-start align-items-center h-75 w-100" id="idInscription" method="POST" action="inscription.php">

                        <div class="form-group col-6 p-4">
                            <label><h1>Inscription</h1></label>
                        </div>

                        <!-- Adresse de courriel -->
                        <div class="form-group has-feedback col-6 p-4">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Adresse courriel" style="font-size : 20px; "/>
                        </div>

                        <!-- Adresse de courriel -->
                        <div class="form-group has-feedback col-6 p-4">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Saissisez à nouveau l'adresse courriel" style="font-size : 20px; "/>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group col-6 p-4">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" style="font-size : 20px;"/>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group col-6 p-4">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Saissisez à nouveau le mot de passe" style="font-size : 20px;"/>
                        </div>

                        <!-- Bouton création compte -->
                        <div class="form-group col-6 p-4">
                            <input type="submit" id="btnConnexion" class="btn btn-primary btn-block w-100" value="S'inscrire" style="font-size : 30px; font-weigth" />
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>