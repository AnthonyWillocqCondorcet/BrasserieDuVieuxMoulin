<?php header('Content-Type: application/json');
require('../utils/all_includes.php');

$prod = new BiereDAO($cnx);
$tab = $prod->updateChampBiere($_GET['champ'], $_GET['nouveau'], $_GET['id_biere']);

print (json_encode($tab));