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
  <link rel="stylesheet" type="text/css" href="index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>
</head>


<body class="container" class="row">

    <img src="" ></img>

    <form method="get" action="" class="col">

        <!-- Bouton s'inscrire -->
        <!-- Logo du service d'annonce -->
        <img src="../images/logo.jpeg" class="col-sm-6"></img>
        <!-- Boite de Connexion -->
        <div class="border rounded col-sm-6">

            <!-- Titre de la boite -->
            <div id="divonnexion" class="form-row text-center justify-content-center">
                <div class="col-sm-4">
                    <h1 id="connexion">Ouvrir une session</h1>
                </div>
            </div>

            <!-- Adresse Courriel -->
            <div class="form-group has-feedback w-25">
                <label class="control-label">Adresse de courriel</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Adresse de courriel"/>
            </div>

            <!-- Mot de Passe -->
            <div class="form-row form-group justify-content-center">
                <div class="col-sm-4">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Mot de Passe" />
                </div>
            </div>

            <!-- Boutton Connexion-->
            <div class="form-row form-group justify-content-center">
                <div class="col-sm-4">
                    <input type="submit" id="btn" class="btn btn-primary btn-block" value="Connexion" />
                </div>
            </div>
        </div>
    </form>

</body>

</html>