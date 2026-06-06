<?php
header('Content-Type: application/json');
require('../utils/all_includes.php');
$biereDAO = new BiereDAO($cnx);
$result = $biereDAO->deleteBiere($_GET['id_biere']);
echo json_encode($result);