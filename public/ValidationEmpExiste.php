<?php
function parametre($strIDParam)
{
    return filter_input(INPUT_GET, $strIDParam, FILTER_SANITIZE_SPECIAL_CHARS) .
        filter_input(INPUT_POST, $strIDParam, FILTER_SANITIZE_SPECIAL_CHARS);
}
require_once("../dbconfig.php");
$intNoEmpl = parametre("NoEmpl");
//console_log($intNoEmpl);
if ($intNoEmpl != null) {
    $cBD = new PDO("mysql:host=localhost;dbname=$strNomBD", $strNomAdmin, $strMotPasseAdmin);
    $sql = "SELECT * FROM utilisateurs WHERE NoEmpl = :NoEmpl";
    $query = $cBD->prepare($sql);
    $query->bindValue(':NoEmpl', $intNoEmpl, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_BOTH);
    if (count($result) == 0) {
        echo false;
    } else {
        echo true;
    }
} else {
    echo false;
}

// function console_log($output, $with_script_tags = true)
// {
//     $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
//         ');';
//     if ($with_script_tags) {
//         $js_code = '<script>' . $js_code . '</script>';
//     }
//     echo $js_code;
// }