<?php
    require_once("../dbconfig.php");
    require_once("classe-fichier-2021-03-07.php");

    // Creation de la db
    $cBD = new PDO("mysql:host=localhost", $strNomAdmin, $strMotPasseAdmin);
    $requete = file_get_contents("pjf_macandcheese.sql");
    $preparerExec = $cBD->prepare($requete);
    $resultat = $preparerExec->execute();
    if ($resultat){
        echo "La base de donnée pjf_macandcheese a été créée";
    }else{ 
        echo "La base de donnée pjf_macandcheese n'a pas pu être créée";
        exit();
    }

    $fichierUtilisateur = new fichier("utilisateurs.csv");
    $strNomDeTable = "utilisateurs";
    $fichierUtilisateur->ouvre();
    while (!$fichierUtilisateur->detecteFin()){
       $tValeur = explode(";", $fichierUtilisateur->litLigne());
       $requete = "INSERT INTO $strNomDeTable VALUES (default,?,?,?,?,?,?,?,?,?,?,?,?,?,default)";
       $preparerExec= $cBD->prepare($requete);
       $preparerExec->execute([$tValeur[1],$tValeur[2],$tValeur[3],$tValeur[4],$tValeur[5],$tValeur[6],$tValeur[7],$tValeur[8],$tValeur[9],$tValeur[10],$tValeur[11],$tValeur[12],$tValeur[13]]);
    }
    $fichierUtilisateur->ferme();

    $fichierConnexions = new fichier("connexions.csv");
    $strNomDeTable = "connexions";
    $fichierConnexions->ouvre();
    while (!$fichierConnexions->detecteFin()){
       $tValeur = explode(";", $fichierConnexions->litLigne());
       $requete = "INSERT INTO $strNomDeTable VALUES (default,?,?,?)";
       $preparerExec= $cBD->prepare($requete);
       $preparerExec->execute([$tValeur[1],$tValeur[2],$tValeur[3]]);
    }
    $fichierConnexions->ferme();

    $fichierCategories = new fichier("categories.csv");
    $strNomDeTable = "categories";
    $fichierCategories->ouvre();
    while (!$fichierCategories->detecteFin()){
       $tValeur = explode(";", $fichierCategories->litLigne());
       $requete = "INSERT INTO $strNomDeTable VALUES (default,?)";
       $preparerExec= $cBD->prepare($requete);
       $preparerExec->execute([$tValeur[1]]);
    }
    $fichierCategories->ferme();

    $fichierAnnonces = new fichier("annonces.csv");
    $strNomDeTable = "annonces";
    $fichierAnnonces->ouvre();
    while (!$fichierAnnonces->detecteFin()){
       $tValeur = explode(";", $fichierAnnonces->litLigne());
       $requete = "INSERT INTO $strNomDeTable VALUES (default,?,?,?,?,?,?,?,?,?)";
       $preparerExec= $cBD->prepare($requete);
       $preparerExec->execute([$tValeur[1],$tValeur[2],$tValeur[3],$tValeur[4],$tValeur[5],$tValeur[6],$tValeur[7],$tValeur[8],$tValeur[9]]);
    }
    $fichierAnnonces->ferme();