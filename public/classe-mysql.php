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
  function insereEnregistrement($strNomTable)
  {
    //$this->requete = "INSERT INTO $strNomTable"
  }
  /*
      |----------------------------------------------------------------------------------|
      | modifieChamp
      |----------------------------------------------------------------------------------|
      */
  function modifieChamp($strNomTable, $strNomChamp, $strNouvelleDefinition)
  {
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
}