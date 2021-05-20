<?php
    $binAffichageAnnonce = false;
    require_once("barreNavigation.php");

    $binConfirmer = parametre("confirmation", true);

    $message = "";

    if ($binConfirmer){
        $sql = 'DELETE FROM annonces WHERE Etat=3';
        $query = $mysql->cBD->prepare($sql);
        $query->execute();
        $sql = 'DELETE FROM utilisateurs WHERE Statut=0 AND TIMESTAMPDIFF(MONTH, Creation, CURDATE()) > 3';
        $query = $mysql->cBD->prepare($sql);
        $query->execute();
        $message = "Le nettoyage de la base de données à bien été effectué.";
    }else{
        $message = "Le nettoyage de la base de données va retirer de façon permanente les utilisateurs 
        qui se sont inscrits il y a plus de trois mois et qui n’ont pas encore confirmé leurs enregistrements 
        et il va aussi supprimer toutes les annonces qui ont un etat de 3 (Retrait).";
    }
?>
        <div class="card text-white <?=$binConfirmer?"bg-success":"bg-danger"?> p-3 m-4">
            <div class="card-body align-items-center d-flex justify-content-center">
            <h3 class="mb-3">Nettoyage de la base de données</h3>
            <p class="px-5 text-center"><?=$message?></p>
            <hr class="mt-2 mb-3 <?=$binConfirmer?"hide":""?>"/>
            <p class="mb-3 <?=$binConfirmer?"hide":""?>">Êtes-vous sûr de vouloir continuer ?</p>
            <a href="NettoyageBaseDeDonnee.php?confirmation=true" class="btn btn-outline-light <?=$binConfirmer?"hide":""?>">Nettoyer</a>
            </div>
        </div>
    </body>
</html>