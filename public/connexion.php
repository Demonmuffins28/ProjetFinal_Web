<?php 
        /**Page de connexion
         * Permet de se connecter au service de petites annonces
         * 
         * 
         * @author Charles Morin,
         * Date de création: 15/04/2021
         */

        //Création de la session
        session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Les Petites Annonces GG</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script defer src="../node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
        <script defer src="../node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
        <script defer src="../node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>
    </head>
    <style>
        html,body {
            height: 100%;
            background-color: rgb(77, 77, 77);
        }
        .form-group {
            font-size: large;
            width: calc(100% - 25rem);
            font-size: 30px;
        }

    </style>

    <body>
        <div class="container-fluid h-100">
            <div class="row h-100">
            <!-- Logo du service d'annonce -->
                <div class="col-5 border-3 border-end border-color h-100 bg-dark border-secondary">
                <img src="../images/logobd2.png" class="img-fluid h-100">
                </div>
                <div class="col-7 h-100" method="POST" action="connexion.php">

                    <!-- Bouton s'inscrire -->
                    <div class="d-flex justify-content-end p-5">
                        <a class="btn btn-primary" style="width: 20%;" href="#" role="button"><h4>S'inscrire!</h4></a>
                    </div>

                    <form class="d-flex flex-column justify-content-start align-items-center h-75 w-100">


                        <div class="form-group col-6 p-3">
                            <label><h1>Ouvrir une session</h1></label>
                        </div>

                        <!-- Adresse de courriel -->
                        <div class="form-group col-6 p-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Adresse courriel" style="font-size : 20px;"/>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group col-6 p-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Mot de Passe" style="font-size : 20px;"/>
                        </div>

                        <!-- Bouton connexion -->
                        <div class="form-group col-6 p-3">
                            <input type="submit" id="btnConnexion" class="btn btn-primary btn-block w-100 font" value="Connexion" style="font-size : 25px;" />
                        </div>

                        <!-- Mot de passe oublié? -->
                        <a href="#" class="link-secondary p-5"><h5>Mot de passe oublié?<h5></a>

                    </form>

                </div>
            </div>
        </div>
    </body>

</html>