<?php
http_response_code(404);
?>

<div class="container text-center py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h1 class="display-1 text-muted mt-5">404</h1>
            <h2 class="mb-3">Page non trouvée</h2>

            <p class="lead mb-4">
                Désolé, la page que vous cherchez n'existe pas.
            </p>

            <a href="index.php" class="btn btn-primary btn-lg">
                Retour à l'accueil
            </a>

            <div class="mt-4">
                <a href="javascript:history.back()" class="text-decoration-none">
                    <- Page précédente
                </a>
            </div>

        </div>
    </div>
</div>