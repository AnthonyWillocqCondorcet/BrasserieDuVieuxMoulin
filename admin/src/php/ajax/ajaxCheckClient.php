<?php
header('Content-Type: application/json');
require('../utils/all_includes.php');

$client = new ClientDAO($cnx);
$cl = $client->getClient($_GET['email'], $_GET['mot_de_passe']);
print json_encode($cl);