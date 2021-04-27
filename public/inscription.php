<?php

require_once("accueil.php");
require_once("libValidation.php");
require_once("envoyerMail.php");

$binInscription = parametre("inscrit", true);

//Regarde si la page a été submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $strEmail = parametre('email1');
  $strPassword = parametre('password1');
  if ($strEmail != null && $strPassword != null) {
    //Insérer l'enregistrement dans la base de données
    date_default_timezone_set("America/New_York");
    $mysql->insereEnregistrement(
      'utilisateurs',
      ['Courriel', 'MotDePasse', 'Creation', 'NbConnexions', 'Statut', 'Modification'],
      ["'" . $strEmail . "'", "'" . $strPassword . "'", "'" . date('Y-m-d H:i:s') . "'", 0, 0, "'" . date('Y-m-d H:i:s') . "'"]
    );
    envoyerMail($strEmail, "Confirmation de votre compte", "http://localhost/ProjetFinal_Web/public/confirmationCourriel.php?id=" . $mysql->getNoUtilisateurs($strEmail));
  }
  header("Location: inscription.php?inscrit=true");
  die();
}

?>

<div class="col-7 h-100">

  <!-- Bouton retour -->
  <div class="d-flex justify-content-end p-5">
    <a class="btn btn-primary" style="width: 20%;" href="connexion.php" role="button">
      <h4>Retour</h4>
    </a>
  </div>

  <form class="d-flex flex-column justify-content-start align-items-center h-75 w-100" id="idInscription" method="POST"
    action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <div id="titre" class="form-group col-6 p-4">
      <label id="titre">
        <h1>Inscription</h1>
      </label>
    </div>

    <!-- Adresse de courriel 1-->
    <div class="form-group has-feedback col-6 p-4 formulaire">
      <label for="email1" class="text-danger"></label>
      <input type="email" id="email1" name="email1" class="form-control" placeholder="Adresse courriel"
        style="font-size : 20px; " />
    </div>

    <!-- Adresse de courriel 2-->
    <div class="form-group has-feedback col-6 p-4 formulaire">
      <label for="email2" class="text-danger"></label>
      <input type="email" id="email2" name="email2" class="form-control"
        placeholder="Saissisez à nouveau l'adresse courriel" style="font-size : 20px; " />
    </div>

    <!-- Mot de passe -->
    <div class="form-group col-6 p-4 formulaire">
      <label for="password1" class="text-danger"></label>
      <input type="password" id="password1" name="password1" class="form-control" placeholder="Mot de passe"
        style="font-size : 20px;" />
    </div>

    <!-- Mot de passe -->
    <div class="form-group col-6 p-4 formulaire">
      <label for="password2" class="text-danger"></label>
      <input type="password" id="password2" name="password2" class="form-control"
        placeholder="Saissisez à nouveau le mot de passe" style="font-size : 20px;" />
    </div>

    <!-- Bouton création compte -->
    <div class="form-group col-6 p-4 formulaire">
      <input type="submit" id="btnInscription" class="btn btn-primary btn-block w-100" value="S'inscrire"
        style="font-size : 30px;" />
    </div>

  </form>

</div>
</div>
</div>
</body>

<script>
if (window.history.replaceState)
  window.history.replaceState(null, null, window.location.href);

$(document).ready(function() {
  const binInscription = <?php echo json_encode($binInscription); ?>;

  $('label[for="email1"]').hide();
  $('label[for="email2"]').hide();
  $('label[for="password1"]').hide();
  $('label[for="password2"]').hide();


  if(!binInscription) {
    //Si l'on appuie sur le boutton "Inscription" cela enclenche plusieurs validations
    $("#idInscription").on("submit", function(event) {

      let binSubmit = true;
      //Regarde si tous les champs sont remplis et non vides
      console.log($("#email1").val().trim());
      if ($("#email1").val().trim() == '' ||
        $("#email2").val().trim() == '' ||
        $("#password1").val().trim() == '' ||
        $("#password2").val().trim() == '') {
        $('label[for="email1"]').show();
        $('label[for="email1"]').html("<h5>Veuillez remplir tous les champs!</h5>");
        binSubmit = false;
      }

      //Si tous les champs ont été remplis, regardé pour les validations spécifiques a ceux-ci
      else if (binSubmit) {
        $('label[for="email1"]').hide();
        $('label[for="email2"]').hide();
        $('label[for="password1"]').hide();
        $('label[for="password2"]').hide();
        //Regarder si la première adresse courriel est valide
        if (!validationEmail($("#email1").val())) {
          $('label[for="email1"]').show();
          $('label[for="email1"]').html("<h5>Addresse Invalide! (exemple@email.com)</h5>");
          binSubmit = false;
        }
        //Regarder si l'email1 et l'email2 sont identiques
        else if ($("#email1").val() != $("#email2").val()) {
          $('label[for="email2"]').show();
          $('label[for="email2"]').html("<h5>Le deux adresses courriels doivent être identiques!</h5>");
          binSubmit = false;
        }
        //Regarder si l'email existe deja
        else if (emailExiste($("#email1").val())) {
          $('label[for="email1"]').show();
          $('label[for="email1"]').html("<h5>Cette adresse email est déjà utilisée</h5>");
          binSubmit = false;
        }

        //Regarde si le mot de passe est valide
        if (!validationMotDePasse($("#password1").val())) {
          $('label[for="password1"]').show();
          $('label[for="password1"]').html("<h5>Mot de passe invalide! (5 à 15 lettres et chiffres)!</h5>");
          binSubmit = false;
        }
        //Regarder si le password1 et le password2 sont identiques
        else if ($("#password1").val() != $("#password2").val()) {
          $('label[for="password2"]').show();
          $('label[for="password2"]').html("<h5>Les deux mots de passes doivent être identiques!</h5>");
          binSubmit = false;
        }
      }
      return binSubmit;
    });
  }
  else {
    $(".formulaire").hide();
    $("#titre").append("<h5>Votre compte à été inscrit, veuillez activer votre compte par courriel!</h5>");
  }

});
</script>

</html>