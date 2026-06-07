<?php
require "php/utils/all_includes.php";
if (!isset($_SESSION['admin'])) {
    header("Location: ../../index_.php?page=login");
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <title>Administration - Brasserie</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index_.php">Admin Brasserie</a>
        <div class="d-flex">
            <span class="navbar-text me-3">Bonjour <?= htmlspecialchars($_SESSION['admin']['prenom'] ?? 'Admin') ?></span>
            <a href="../content/disconnect.php" class="btn btn-danger btn-sm">Déconnexion</a>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <?php
    $page = $_GET['page'] ?? 'dashboard';
    $page = basename($page, '.php');
    $path = "../content/" . $page . ".php";
    if (file_exists($path)) {
        include($path);
    } else {
        include("../content/accueil.php");
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>