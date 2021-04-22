<?php
    require_once("accueil.php");
    require_once("libValidation.php");
?>

<div class="col-7 h-100">

                    <!-- Bouton retour -->
                    <div class="d-flex justify-content-end p-5">
                        <a class="btn btn-primary" style="width: 20%;" href="connexion.php" role="button"><h4>Retour</h4></a>
                    </div>

                    <form class="d-flex flex-column justify-content-start align-items-center h-75 w-100" id="idMotDePasseOublier" method="POST" action="oublierMotDePasse.php">

                        <div class="form-group col-6 p-4 text-center">
                            <label><h1>Mot de passe oublié</h1></label>
                        </div>

                        <div class="form-group has-feedback col-6 p-4 text-center">
                            <label><h5 id="message">Veuillez entrer votre adresse de courriel ci-dessous et nous vous enverrons un courriel pour recupérer votre mot de passe.</h5></label>
                        </div>

                        <!-- Adresse de courriel -->
                        <div class="form-group has-feedback col-6 p-4 text-center">
                            <label for="email" class="text-danger" id="lblMessageErreur" style="font-size : 20px;"></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Adresse courriel" style="font-size : 20px; "/>
                        </div>

                        <!-- Bouton envoyer un courriel -->
                        <div class="form-group col-6 p-4">
                            <input type="button" class="btn btn-primary btn-block w-100" id="btnConnexion" value="Envoyer un courriel" style="font-size : 30px;"/>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script>
            // Validation
            $(document).ready(function () {
                $('#btnConnexion').click(function () {
                    $('#lblMessageErreur').html("");
                    let binValider = true;
                    if ($('#email').val().trim() == ''){
                        binValider = false;
                        $('#lblMessageErreur').html("Veuillez entrer un email");
                    }
                    else if (!validationEmail($('#email').val().trim())){
                        binValider = false;
                        $('#lblMessageErreur').html("Le email entrer est invalid");
                    }
                    else if (!emailExiste($('#email').val())){
                        binValider = false;
                        $('#lblMessageErreur').html("Le email entrer n'existe pas");
                    }
                    if (binValider){
                        $('#email').hide();
                        $('#btnConnexion').hide();
                        $('#message').html("Votre mot de passe vous a été envoyé par email");
                    }
                });
            });

            function ajax(url, type, data){
                binEmailExiste = $.ajax({
                                    url: url,
                                    type: type,
                                    data: data,
                                    async: false
                                }).responseText
                return binEmailExiste;
            }
        </script>
    </body>