<?php

/**
 * Validation en php
 */

?>

<script>
/**
 * Validation en JS
 */

function validationEmail(strEmail) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(strEmail);
}

function validationMotDePasse(strMotDePasse) {
  return strMotDePasse.length >= 5 && strMotDePasse.length <= 15
}

function validationNomPrenom(strNomPrenom) {
  return /^[A-Za-z\u00C0-\u017F]+([A-Za-z\u00C0-\u017F ]|'|-){1}[A-Za-z\u00C0-\u017F]+$/.test(strNomPrenom);
}

function validationTelMaisonCellulaire(strTel) {
  return /^\(\d{3}\)\s\d{3}-\d{4}$/.test(strTel);;
}

function validationTelTravail(strTel) {
  return /^\(\d{3}\)\s\d{3}-\d{4}\s#\d{4}$/.test(strTel);;
}

function validationStatutUtilisateurs(strStatut) {
  return /^[0-5]{1}$/.test(strStatut);
}

function validationEtatAnnonce(strEtat) {
  return /^[1-3]{1}$/.test(strEtat);
}

function validationNoEmployer(strNoEmployer) {
  return /^[1-9]{1}[0-9]{0,3}$/.test(strNoEmployer);
}

function validationPrix(strPrix) {
  return isNaN(parseFloat(strPrix)) ? false : parseFloat(strPrix) >= 0 && parseFloat(strPrix) <= 99999.99
}

function emailExiste(strEmail) {
  binEmailExiste = $.ajax({
    url: "ValidationEmailExiste.php",
    type: "post",
    data: {
      email: strEmail
    },
    async: false
  }).responseText
  return binEmailExiste;
}

function noEmployeExiste(strNoEmpl) {
  binNoEmp = $.ajax({
    url: "ValidationEmpExiste.php",
    type: "post",
    data: {
      NoEmpl: strNoEmpl
    },
    async: false
  }).responseText
  return binNoEmp;

}
</script>