<?php

/**Page de connexion
 * Permet de se connecter au service de petites annonce
 * @author Charles Morin,
 * Date de création: 15/04/2021
 */

//Création de la session
session_start();
require_once("libValidation.php");
require_once("accueil.php");
?>
<div class="col-7 h-100">
  <!-- Bouton s'inscrire -->
  <div class="d-flex justify-content-end p-5">
    <a class="btn btn-primary" style="width: 20%;" href="inscription.php" role="button">
      <h4>S'inscrire!</h4>
    </a>
  </div>

  <form class="d-flex flex-column justify-content-start align-items-center h-75 w-100" id="idConnexion" method="POST"
    action="connexion.php">

    <div class="form-group col-6 p-4">
      <label>
        <h1>Ouvrir une session</h1>
      </label>
    </div>

    <!-- Adresse de courriel -->
    <div class="form-group has-feedback col-6 p-4">
      <input type="email" id="email" name="email" class="form-control" placeholder="Adresse courriel"
        style="font-size : 20px; " />
    </div>

    <!-- Mot de passe -->
    <div class="form-group col-6 p-4">
      <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe"
        style="font-size : 20px;" />
    </div>

    <!-- Bouton connexion -->
    <div class="form-group col-6 p-4">
      <input type="submit" id="btnConnexion" class="btn btn-primary btn-block w-100" value="Connexion"
        style="font-size : 30px;" />
    </div>

    <!-- Mot de passe oublié? -->
    <a href="oublierMotDePasse.php" class="link-secondary py-5">
      <h5>Mot de passe oublié?<h5>
    </a>

  </form>
</div>
</body>

</html>