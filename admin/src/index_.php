<?php
session_start();
require "src/php/utils/all_includes.php";
if(isset($_SESSION['admin']) && !isset($_SESSION['page'])) {
    $_SESSION['page']="accueil.php";
}

?>
<!doctype html>
<html lang="fr">
<head>
    <title>Brasserie du Vieux Moulin</title>
    <meta charSet="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>
    <script src="admin/assets/js/fonctionJquery.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"
</head>
<body>
<div id="wrapper">
    <header id="header">
        <?php
        if(file_exists('src/php/utils/admin_menu.php')){
            include('src/php/utils/admin_menu.php');
        }
        ?>
    </header>
    <main id="main_admin">
        <section id="contenu">
            <?php

            if(!isset($_SESSION['admin'])){
                $path = "content/login.php";
            }else {
                if(isset($_GET['page'])){
                    $_SESSION['page']=$_GET['page'];
                }
                if(!isset($_SESSION['page']))
                {
                    $_SESSION['page']="accueil.php";
                }
                $path = "content/" . $_SESSION["page"];
            }

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