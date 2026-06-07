<?php
require "admin/src/php/utils/all_includes.php";
?>
<!doctype html>
<html lang="fr">
<head>
    <title>Brasserie du Vieux Moulin</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="admin/assets/css/style.css" rel="stylesheet">
    <style>
        /* Sticky footer : le body prend toute la hauteur */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        #wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <header id="header">
        <?php include('admin/src/php/utils/header.php'); ?>
        <?php include('admin/src/php/utils/public_menu.php'); ?>
    </header>
    <main id="main">
        <section id="contenu" class="container mt-4">
            <?php
            $page = $_GET['page'] ?? 'accueil';
            // Sécurisation : on nettoie le nom de la page
            $page = preg_replace('/[^a-z_\-]/i', '', $page);
            $path = "content/" . $page . ".php";
            if (file_exists($path)) {
                include($path);
            } else {
                include("content/page404.php");
            }
            ?>
        </section>
    </main>
    <footer id="footer">
        <?php include('admin/src/php/utils/footer.php'); ?>
    </footer>
</div>
</body>
</html>