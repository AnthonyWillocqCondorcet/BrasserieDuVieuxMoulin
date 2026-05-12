<?php
session_start();
require "admin/src/php/utils/all_includes.php";

?>
<!doctype html>
<html lang="fr">
<head>
    <title>Brasserie du Vieux Moulin</title>
    <meta charSet="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>

</head>
<body>
<div id="wrapper">
    <header id="header">
        <?php
        if(file_exists('admin/src/php/utils/public_menu.php')){
            include('admin/src/php/utils/public_menu.php');
        }
        ?>
    </header>
    <main id="main">
        <section id="contenu">
            <?php
            if(!isset($_SESSION['page'])){
                $_SESSION['page']="accueil.php";
            }
            if(isset($_GET["page"])){
                $_SESSION['page']=$_GET["page"];
            }
            $path = "content/" . $_SESSION["page"];

            if(isset($path)){
                include($path);
            }else{
                include ("content/page404.php");
            }
            ?>
        </section>
    </main>

    <footer id="footer">
        <p>Footer</p>
    </footer>
</div>
</body>
</html>