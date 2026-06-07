<?php
require_once '../utils/all_includes.php';
require_once '../utils/check_connexion.php';

$champ = $_GET['champ'] ?? '';
$nouveau = $_GET['nouveau'] ?? '';
$id_biere = (int)($_GET['id_biere'] ?? 0);

if (!$champ || !$id_biere) {
    http_response_code(400);
    echo "Paramètres invalides";
    exit;
}

$biereDAO = new BiereDAO($cnx);
$result = $biereDAO->updateChampBiere($champ, $nouveau, $id_biere);

echo json_encode($result);