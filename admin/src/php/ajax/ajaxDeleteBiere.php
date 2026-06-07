<?php
require_once '../utils/all_includes.php';
require_once '../utils/check_connexion.php';

if (!isset($_GET['id_biere'])) {
    http_response_code(400);
    echo "ID manquant";
    exit;
}

$id_biere = (int)$_GET['id_biere'];
$biereDAO = new BiereDAO($cnx);
$result = $biereDAO->deleteBiere($id_biere);

if ($result) {
    echo "ok";
} else {
    http_response_code(500);
    echo "Erreur lors de la suppression";
}