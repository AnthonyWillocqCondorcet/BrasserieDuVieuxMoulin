<?php
session_start();

// Détection environnement
$isAdmin = str_contains($_SERVER['REQUEST_URI'], '/admin/src/') || str_contains($_SERVER['REQUEST_URI'], '/admin/src/php/ajax/');

if ($isAdmin) {
    $pathDb = __DIR__ . '/../db/db_pg_connect.php';
    $pathAutoloader = __DIR__ . '/../classes/Autoloader.class.php';
} else {
    $pathDb = __DIR__ . '/../../../../admin/src/php/db/db_pg_connect.php';
    $pathAutoloader = __DIR__ . '/../../../../admin/src/php/classes/Autoloader.class.php';
}

if (file_exists($pathDb) && file_exists($pathAutoloader)) {
    require_once $pathDb;
    require_once $pathAutoloader;
    Autoloader::register();
    $cnx = Connexion::getInstance($dsn, $user, $pass);
} else {
    die("Fichiers de configuration manquants.");
}

if (!function_exists('getImageUrl')) {
    function getImageUrl($imageName) {
        if (empty($imageName)) {
            return "admin/assets/images/default.jpg";
        }
        if (filter_var($imageName, FILTER_VALIDATE_URL)) {
            return $imageName;
        }
        return "admin/assets/images/" . ltrim($imageName, '/');
    }
}