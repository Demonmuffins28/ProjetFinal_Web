<?php
    require_once("../dbconfig.php");
    require_once("accueil.php");

    ///confirmer
    $intID = isset($_GET["id"]) ? $_GET["id"] : null;
    $cBD = new PDO("mysql:host=localhost;dbname=$strNomBD", $strNomAdmin, $strMotPasseAdmin);
    $strMessageAfficher = "";

    if ($intID != null){
        $sql = "SELECT Statut, NoUtilisateur FROM utilisateurs WHERE NoUtilisateur = $intID";
        $query = $cBD->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_BOTH);

        if (count($result) == 0){
            $strMessageAfficher = "Ce lien n'est plus actif. Vous devez créer un nouveau compte.";

        }
        else if ($result[0]["Statut"] != 0) {
            $strMessageAfficher = "Ce compte Les Petites Annonces GG à déjà été comfirmer. Vous pouvez vous connecter.";
        }
        else{
            $strMessageAfficher = "Votre compte Les Petites Annonces GG à bien été comfirmer. Vous pouvez à présent vous connecter.";
            $sql = "UPDATE utilisateurs SET Statut = 9 WHERE NoUtilisateur = $intID";
            $query = $cBD->prepare($sql);
            $query->execute();
        }
    }
    else {
        $strMessageAfficher = "Ce lien n'est plus actif. Vous devez créer un nouveau compte.";
    }
?>

<div class="col-7 h-100">
        <!-- Bouton retour -->
    <div class="d-flex justify-content-end p-5">
        <a class="btn btn-primary" style="width: 20%;" href="connexion.php" role="button"><h4>Connexion</h4></a>
    </div>

    <div class="d-flex flex-column justify-content-start align-items-center h-75 w-100">

        <div class="form-group col-6 p-4 text-center">
            <label><h1>Confirmation de votre compte</h1></label>
        </div>

        <div class="form-group has-feedback col-6 text-center">
            <label><h5 id="message"><?php echo $strMessageAfficher?></h5></label>
        </div>
    </div>
</div>
