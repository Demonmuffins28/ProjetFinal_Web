<?php
//Création de la session
require_once("classe-mysql.php");

function parametre($strIDParam)
{
    return filter_input(INPUT_GET, $strIDParam, FILTER_SANITIZE_SPECIAL_CHARS) .
        filter_input(INPUT_POST, $strIDParam, FILTER_SANITIZE_SPECIAL_CHARS);
}

$strInfosSensibles = "../dbconfig.php";
$mysql = new mysql($strInfosSensibles);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Les Petites Annonces GG|Mac'N'Cheese</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
  <script defer src="../node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<style>
html,
body {
  height: 100%;
  background-color: rgb(248, 248, 248);
}

.form-group {
  font-size: large;
  width: calc(100% - 25rem);
  font-size: 30px;
}
</style>

<body>
  <div class="container-fluid h-100">
    <div class="row h-100">
      <!-- Logo du service d'annonce -->
      <div class="col-5 border-3 border-end border-color h-100 bg-dark border-secondary">
        <img src="../images/logobd.png" class="img-fluid h-100">
      </div>