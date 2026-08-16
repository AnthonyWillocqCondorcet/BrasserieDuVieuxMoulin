<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index_.php?page=accueil">🍺 Brasserie du Vieux Moulin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index_.php?page=accueil">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="index_.php?page=bieres">Toutes les bières</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="couleurDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Couleurs
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="couleurDropdown">
                        <li><a class="dropdown-item" href="index_.php?page=bieres&couleur=Ambre">Ambrée</a></li>
                        <li><a class="dropdown-item" href="index_.php?page=bieres&couleur=Blonde">Blonde</a></li>
                        <li><a class="dropdown-item" href="index_.php?page=bieres&couleur=Rouge">Rouge</a></li>
                        <li><a class="dropdown-item" href="index_.php?page=bieres&couleur=Brune">Brune</a></li>
                        <li><a class="dropdown-item" href="index_.php?page=bieres&couleur=Rose fruitée">Rose fruitée</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="index_.php?page=bieres&prix=ASC">Prix</a></li>
                <li class="nav-item"><a class="nav-link" href="index_.php?page=bieres&sans_alcool=1">Sans alcool</a></li>
                <?php if (isset($_SESSION['client']) || isset($_SESSION['admin'])): ?>
                    <li class="nav-item"><a class="nav-link" href="content/disconnect.php">Déconnexion</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=login">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=compte">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>