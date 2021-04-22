<?php 

    require_once("accueil.php");

    //Recupérer les 2 adresses courriels de la requete post
    $strEmail1 = isset($_POST["email"]) ? $_POST["email"] : null;
    $strEmail2 = isset($_POST["email"]) ? $_POST["email"] : null;

    //Recupérer le mot de passe de la requete post
    

    //Regarder si elle existe
    //if($strEmail != null && $str){}
    //Si oui, envoyé un courriel a cette adresse avec le mot de passe
    //Si non, envoyé un message indiquant l'adresse indiqué n'existe pas

?>

                <div class="col-7 h-100">

                    <!-- Bouton retour -->
                    <div class="d-flex justify-content-end p-5">
                        <a class="btn btn-primary" style="width: 20%;" href="connexion.php" role="button"><h4>Retour</h4></a>
                    </div>

                    <form class="d-flex flex-column justify-content-start align-items-center h-75 w-100" id="idInscription" method="POST" action="">

                        <div class="form-group col-6 p-4">
                            <label><h1>Inscription</h1></label>
                        </div>

                        <!-- Adresse de courriel 1-->
                        <div class="form-group has-feedback col-6 p-4">
                            <label for="email1" class="text-danger"></label>
                            <input type="email" id="email1" name="email1" class="form-control" placeholder="Adresse courriel" style="font-size : 20px; "/>
                        </div>

                        <!-- Adresse de courriel 2-->
                        <div class="form-group has-feedback col-6 p-4">
                            <label for="email2"></label>
                            <input type="email" id="email2" name="email2" class="form-control" placeholder="Saissisez à nouveau l'adresse courriel" style="font-size : 20px; "/>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group col-6 p-4">
                            <label for="password1"></label>
                            <input type="password" id="password1" name="password1" class="form-control" placeholder="Mot de passe" style="font-size : 20px;"/>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group col-6 p-4">
                            <label for="password2"></label>
                            <input type="password" id="password2" name="password2" class="form-control" placeholder="Saissisez à nouveau le mot de passe" style="font-size : 20px;"/>
                        </div>

                        <!-- Bouton création compte -->
                        <div class="form-group col-6 p-4">
                            <input type="submit" id="btnInscription" class="btn btn-primary btn-block w-100" value="S'inscrire" style="font-size : 30px;" />
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>

    <script>

        //Si l'on appuie sur le boutton "Inscription" cela enclenche plusieurs validations
        $(document).ready(function() {

            $('label[for="email1"]').hide();
            $('label[for="email2"]').hide();
            $('label[for="password1"]').hide();
            $('label[for="password2"]').hide();

            //Si la form à été submit
            $("#idInscription").submit(function(event) {
                //Regarde si tous les champs sont remplis et non vides
                let binSubmit = true;
                console.log($("#email1").val().trim());
                if($("#email1").val().trim() == '' 
                || $("#email2").val().trim() == '' 
                || $("#password1").val().trim() == '' 
                || $("#password2").val().trim() == '') {
                    $('label[for="email1"]').show();
                    $('label[for="email1"]').html("<h5>Veuillez remplir tous les champs!</h5>");
                    binSubmit = false;
                }

                //Si tous les champs ont été remplis, regardé pour les validations spécifiques a ceux-ci
                if(!binSubmit) {
                    $('label[for="email1"]').hide();
                    //Regarder si les deux addresses courriel sont valides
                    console.log(!validationEmail($("#email1").val().trim()));
                    if(!validationEmail($("#email1").val().trim())) {
                        $('label[for="email1"]').show();
                        $('label[for="email1"]').html("<h5>Addresse Invalide!</h5>");
                        binSubmit = false;
                    }
                }
                event.preventDefault();

                return false;
            });

        });

    </script>
</html>