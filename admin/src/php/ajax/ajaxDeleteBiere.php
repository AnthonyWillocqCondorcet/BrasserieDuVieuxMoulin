<?php header('Content-Type: application/json');
require('../utils/all_includes.php');

$prod = new BiereDAO($cnx);
$tab = $prod->deleteBiere($_GET['id_biere']);
var_dump($_GET);

print (json_encode($tab));