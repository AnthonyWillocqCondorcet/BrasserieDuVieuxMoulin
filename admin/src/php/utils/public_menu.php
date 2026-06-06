<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index_.php?page=accueil">🍺 Brasserie du Vieux Moulin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index_.php?page=accueil">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="index_.php?page=bieres_par_couleur&couleur=Ambre">Ambrées</a></li>
                <li class="nav-item"><a class="nav-link" href="index_.php?page=bieres_par_couleur&couleur=Blonde">Blondes</a></li>
                <li class="nav-item"><a class="nav-link" href="index_.php?page=bieres_par_prix">Prix</a></li>
                <li class="nav-item"><a class="nav-link" href="index_.php?page=bieres_sans_alcool">Sans alcool</a></li>
                <?php if (isset($_SESSION['client'])): ?>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=disconnect">Déconnexion</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=login">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="index_.php?page=compte">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>