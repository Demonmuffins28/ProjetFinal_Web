<?php
    $binAffichageAnnonce = false;
    require_once("barreNavigation.php");

    $sql = 'SELECT * FROM utilisateurs';
    $query = $mysql->cBD->prepare($sql);
    $query->execute();
    $tUtilisateur = $query->fetchAll(PDO::FETCH_ASSOC);
    array_multisort(array_column($tUtilisateur, 'Nom'), SORT_ASC, array_column($tUtilisateur, 'Prenom'), SORT_ASC, $tUtilisateur);

    function getDateDernierConDecon($noUtilisateur, $cBD){
        $sql = "SELECT Connexion, IFNULL(Deconnexion, 'Session ouverte') AS Deconnexion FROM `connexions` WHERE NoUtilisateur = $noUtilisateur ORDER BY Connexion DESC LIMIT 5";
        $query = $cBD->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<div class="m-2">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center my-3">
            <h2 class="heading-section text-white">Utilisateurs</h2>
        </div>
    </div>
    <div class="table-wrap">
        <table class="table table-bordered table-dark table-hover border border-secondary rounded">
            <thead>
                <tr>
                    <th style="width: 120px;">NoUtilisateur</th>
                    <th>Courriel</th>
                    <th>Creation</th>
                    <th>NbConnexions</th>
                    <th>Statut</th>
                    <th>NoEmpl</th>
                    <th>Nom Complet</th>
                    <th>NoTelMaison</th>
                    <th>NoTelTravail</th>
                    <th>NoTelCellulaire</th>
                    <th>Modification</th>
                    <th>Dates dernieres connexions</th>
                    <th>Dates dernieres deconnexions</th>
                    <th>Nb annonces actif</th>
                    <th>Nb annonces inactif</th>
                    <th>Nb annonces retiré</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0;$i<count($tUtilisateur);$i++) {
                        $tConnexionDeconnexion = getDateDernierConDecon($tUtilisateur[$i]["NoUtilisateur"], $mysql->cBD);
                        $tConnexion = array_column($tConnexionDeconnexion, "Connexion");
                        $tDeconnexion = array_column($tConnexionDeconnexion, "Deconnexion");

                        $sql = "SELECT COUNT(NoAnnonce) FROM `annonces` WHERE NoUtilisateur=? AND Etat=?";
                        $query = $mysql->cBD->prepare($sql);
                        $query->execute([$tUtilisateur[$i]["NoUtilisateur"],1]);
                        $NbAnnonceActif = $query->fetchAll(PDO::FETCH_BOTH)[0][0];

                        $query = $mysql->cBD->prepare($sql);
                        $query->execute([$tUtilisateur[$i]["NoUtilisateur"],2]);
                        $NbAnnonceInactif = $query->fetchAll(PDO::FETCH_BOTH)[0][0];

                        $query = $mysql->cBD->prepare($sql);
                        $query->execute([$tUtilisateur[$i]["NoUtilisateur"],3]);
                        $NbAnnonceRetirer = $query->fetchAll(PDO::FETCH_BOTH)[0][0];
                ?>
                    <tr>
                        <th scope="row"><?=$tUtilisateur[$i]["NoUtilisateur"]?></th>
                        <td><?=$tUtilisateur[$i]["Courriel"]?></td>
                        <td><?=$tUtilisateur[$i]["Creation"]?></td>
                        <td><?=$tUtilisateur[$i]["NbConnexions"]?></td>
                        <td><?=$tUtilisateur[$i]["Statut"]?></td>
                        <td><?=$tUtilisateur[$i]["NoEmpl"]?></td>
                        <td><?=$tUtilisateur[$i]["Nom"].", ".$tUtilisateur[$i]["Prenom"]?></td>
                        <td><?=$tUtilisateur[$i]["NoTelMaison"]?></td>
                        <td><?=$tUtilisateur[$i]["NoTelTravail"]?></td>
                        <td><?=$tUtilisateur[$i]["NoTelCellulaire"]?></td>
                        <td><?=$tUtilisateur[$i]["Modification"]?></td>
                        <td><?=implode("<br/>_________________<br/>",$tConnexion)?></td>
                        <td><?=implode("<br/>_________________<br/>",$tDeconnexion)?></td>
                        <td><?=$NbAnnonceActif?></td>
                        <td><?=$NbAnnonceInactif?></td>
                        <td><?=$NbAnnonceRetirer?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>