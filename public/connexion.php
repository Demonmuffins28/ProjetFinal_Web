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

function accesMenuPrincipale()
{
  if ($_SESSION["nom"] == "" || $_SESSION["nom"] == "")
    header("Location: gestionProfil.php");
  else header("Location: menuPrincipale.php");
  die();
}

if (isset($_SESSION["userID"]) && isset($_SESSION["connexionID"])) {
  accesMenuPrincipale();
}

$strEmail = parametre("email");
$strPassword = parametre("password");
$strErreurConnexion = "";

if ($strEmail != '') {
  $sql = 'SELECT * FROM utilisateurs WHERE Courriel=:email';
  $query = $mysql->cBD->prepare($sql);
  $query->bindValue(':email', $strEmail, PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  if ($result != null) {
    foreach ($result as $user) {
      if ($strPassword === $user['MotDePasse'] && $user['Statut'] != 0) {
        // Connexion avec session
        $_SESSION["userID"] = $user['NoUtilisateur'];
        $_SESSION["email"] = $user['Courriel'];
        $_SESSION["nom"] = $user['Nom'];
        $_SESSION["prenom"] = $user['Prenom'];
        //Update du nb de connexion
        $sql = 'UPDATE utilisateurs SET NbConnexions= NbConnexions + 1 WHERE NoUtilisateur=' . $_SESSION['userID'];
        $query = $mysql->cBD->prepare($sql)->execute();
        //Ajout du log de connexion
        $mysql->insereEnregistrement('connexions', ['NoUtilisateur', 'Connexion'], [$_SESSION["userID"], 'CURRENT_TIMESTAMP']);
        //Creation de la variable de session de connexion
        $_SESSION["connexionID"] = $mysql->cBD->lastInsertId();
        accesMenuPrincipale();
      } else if ($strPassword === $user['MotDePasse'] && $user['Statut'] == 0) {
        $strErreurConnexion = "**Veuillez confirmer votre compte par adresse courriel**";
      } else {
        $strErreurConnexion = "**Le courriel ou le mot de passe n'est pas correct**";
      }
    }
  } else {
    $strErreurConnexion = "**Le courriel ou le mot de passe n'est pas correct**";
  }
}
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
      <p style="color:red; font-size:20px; text-align:center"><?= $strErreurConnexion ?></p>
    </div>

    <!-- Mot de passe oublié? -->
    <a href="oublierMotDePasse.php" class="link-secondary py-5">
      <h5>Mot de passe oublié?<h5>
    </a>

  </form>
</div>
<script>
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$("#idConnexion").on("submit", function() {
  return isValidForm();
})

function isValidForm() {
  let binErreur = false;
  $("#erreur").remove();
  if (!validationEmail($("#email").val())) {
    $("#email").after("<div id='erreur'><p style='color:red; font-size:20px'>*Le courriel n'est pas valide</p></div>");
    binErreur = true;
  }
  if (binErreur) return false;
  return true;
}
</script>
</body>

</html>