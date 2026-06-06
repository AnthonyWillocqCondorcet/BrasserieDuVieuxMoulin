<?php
header('Content-Type: application/json');
require('../utils/all_includes.php');
$clientDAO = new ClientDAO($cnx);
$client = $clientDAO->getClient($_GET['email'], $_GET['mot_de_passe']);
echo json_encode($client);