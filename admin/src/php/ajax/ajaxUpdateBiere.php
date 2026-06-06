<?php
header('Content-Type: application/json');
require('../utils/all_includes.php');
$biereDAO = new BiereDAO($cnx);
$result = $biereDAO->updateChampBiere($_GET['champ'], $_GET['nouveau'], $_GET['id_biere']);
echo json_encode($result);