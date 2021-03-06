<?php
/*
   |----------------------------------------------------------------------------------------|
   | class mysql
   |----------------------------------------------------------------------------------------|
   */
class mysql
{
  /*
      |----------------------------------------------------------------------------------|
      | Attributs
      |----------------------------------------------------------------------------------|
      */
  public $cBD = null;                       /* Identifiant de connexion */
  public $listeEnregistrements = null;      /* Liste des enregistrements retournés */
  public $nomFichierInfosSensibles = "";    /* Nom du fichier 'InfosSensibles' */
  public $nomBD = "";                       /* Nom de la base de données */
  public $OK = false;                       /* Opération réussie ou non */
  public $requete = "";                     /* Requête exécutée */
  /*
      |----------------------------------------------------------------------------------|
      | __construct
      |----------------------------------------------------------------------------------|
      */
  function __construct($strNomFichierInfosSensibles)
  {
    $this->nomFichierInfosSensibles = $strNomFichierInfosSensibles;
    $this->connexion();
    $this->nomBD = $this->cBD->query('select database()')->fetchColumn();
    //$this->selectionneBD();
  }
  /*
      |----------------------------------------------------------------------------------|
      | connexion()
      |----------------------------------------------------------------------------------|
      */
  function connexion()
  {
    require($this->nomFichierInfosSensibles);
    try {
      $this->cBD = new PDO('mysql:host=localhost;dbname=' . $strNomBD, $strNomAdmin, $strMotPasseAdmin);
      $this->cBD->exec('SET NAMES "UTF8"');
    } catch (PDOException $e) {
      echo 'Erreur : ' . $e->getMessage();
      die();
    }
    return $this->cBD;
  }
  /*
      |----------------------------------------------------------------------------------|
      | copieEnregistrements
      |----------------------------------------------------------------------------------|
      */
  function copieEnregistrements($strNomTableSource, $strListeChampsSource, $strNomTableCible, $strListeChampsCible, $strListeConditions = "")
  {
    /* Réf.: www.lecoindunet.com/dupliquer-ou-copier-des-lignes-d-une-table-vers-une-autre-avec-mysql-175 */
  }
  /*
      |----------------------------------------------------------------------------------|
      | creeTable
      |----------------------------------------------------------------------------------|
      */
  function creeTable($strNomTable)
  {
    $this->requete = "CREATE TABLE $strNomTable (";
    /* À chaque champ, son type */
    for ($i = 1; $i < func_num_args() - 1; $i += 2) {
      $strNomChamp = func_get_arg($i);
      $this->requete .= $strNomChamp . " " . func_get_arg($i + 1) . ", ";
    }
    /* Ajout de la clé primaire */
    $this->requete .= func_get_arg($i) . ")";
    $this->requete .= " ENGINE=InnoDB"; /* https://fr.wikipedia.org/wiki/InnoDB */
    /* Exécution de la requête */
    $this->cBD->exec($this->requete);
    return $this->OK;
  }
  /*
      |----------------------------------------------------------------------------------|
      | creeTableGenerique()
      |----------------------------------------------------------------------------------|
      */
  function creeTableGenerique($strNomTable, $strDefinitions, $strCles)
  {
  }
  /*
      |----------------------------------------------------------------------------------|
      | deconnexion
      |----------------------------------------------------------------------------------|
      */
  function deconnexion()
  {
  }
  /*
      |----------------------------------------------------------------------------------|
      | insereEnregistrement
      |----------------------------------------------------------------------------------|
      */
  function insereEnregistrement($strNomTable, $tabChamps, $tabValeurs)
  {
    if (count($tabChamps) == count($tabValeurs)) {
      //Créer la requete
      $this->requete = "INSERT INTO $strNomTable (";

      for ($i = 0; $i < count($tabChamps); $i++) {
        if ($i == count($tabChamps) - 1)
          $this->requete .= $tabChamps[$i] . ")  VALUES (";
        else
          $this->requete .= $tabChamps[$i] . ", ";
      }

      for ($i = 0; $i < count($tabValeurs); $i++) {
        if ($i == count($tabValeurs) - 1)
          $this->requete .=  $tabValeurs[$i] . ");";
        else
          $this->requete .= $tabValeurs[$i] . ", ";
      }

      //Envoyer la requete
      $this->cBD->exec($this->requete);
    }
  }

  /*
      |----------------------------------------------------------------------------------|
      | modifieChamp
      |----------------------------------------------------------------------------------|
      */
  function modifieChamp($strNomTable, $strNomChamp, $strNouvelleDefinition)
  {
    // $sql = 'UPDATE ' .$strNomTable. ' SET ' .$strNomChamp. ' WHERE'
  }
  /*
      |----------------------------------------------------------------------------------|
      | selectionneBD()
      |----------------------------------------------------------------------------------|
      */
  function selectionneBD()
  {
    $this->OK = mysqli_select_db($this->cBD, $this->nomBD);
    return $this->OK;
  }
  /*
      |----------------------------------------------------------------------------------|
      | supprimeEnregistrements
      |----------------------------------------------------------------------------------|
      */
  function supprimeEnregistrements($strNomTable, $strListeConditions = "")
  {
  }
  /*
      |----------------------------------------------------------------------------------|
      | supprimeTable()
      |----------------------------------------------------------------------------------|
      */
  function supprimeTable($strNomTable)
  {
  }
  /*
      |----------------------------------------------------------------------------------|
      | afficheInformationsSurBD()
      | Affiche la structure et le contenu de chaque table de la base de données recherchée
      |----------------------------------------------------------------------------------|
      */
  function afficheInformationsSurBD()
  {
  }

   /*
      |----------------------------------------------------------------------------------|
      |
      |
      |----------------------------------------------------------------------------------|
      */
  function getNoUtilisateurs($strEmail) {
    $this->requete = 'SELECT NoUtilisateur FROM utilisateurs WHERE Courriel=:email';
    $query =  $this->cBD->prepare($this->requete);
    $query->bindValue(':email', $strEmail, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['NoUtilisateur'];
  }


  /*
      |----------------------------------------------------------------------------------|
      | getChampsTable() #TODO Est inutile pour l'instant
      | Retourne un tableau contenant le nom des différentes colonnes de la table
      |----------------------------------------------------------------------------------|
      */
  function getChampsTable($strNomTable)
  {
    $this->requete = "SELECT column_name
    FROM information_schema.columns
    WHERE table_schema = ? AND table_name = ?;";

    $query =  $this->cBD->prepare($this->requete);
    $query->execute([$this->nomBD, $strNomTable]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  function getChampsType($strNomTable)
  {
    $this->requete = "SELECT COLUMN_NAME, DATA_TYPE
    FROM information_schema.columns
    WHERE table_schema = ? AND table_name = ?;";

    $query =  $this->cBD->prepare($this->requete);
    $query->execute([$this->nomBD, $strNomTable]);
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}