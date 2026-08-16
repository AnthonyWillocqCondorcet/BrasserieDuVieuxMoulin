<?php
require_once "admin/src/php/classes/BiereDAO.class.php";
$biereDAO = new BiereDAO($cnx);

$ambree = $biereDAO->getBieresByCouleur('Ambre');
$imageAmbre = !empty($ambree) ? getImageUrl($ambree[0]['image']) : 'admin/assets/images/default.jpg';

$blonde = $biereDAO->getBieresByCouleur('Blonde');
$imageBlonde = !empty($blonde) ? getImageUrl($blonde[0]['image']) : 'admin/assets/images/default.jpg';

$sansAlcool = $biereDAO->getBieresSansAlcool();
$imageSans = !empty($sansAlcool) ? getImageUrl($sansAlcool[0]['image']) : 'admin/assets/images/default.jpg';
?>

<h1>Bienvenue à la Brasserie du Vieux Moulin</h1>
<p>Découvrez nos bières artisanales brassées avec passion.</p>
<div class="row">
    <!-- Ambrée -->
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($imageAmbre) ?>" class="card-img-top" alt="Bière ambrée">
            <div class="card-body">
                <h5 class="card-title">Bières Ambrées</h5>
                <p class="card-text">Couleur cuivrée, notes caramélisées.</p>
                <a href="index_.php?page=bieres&couleur=Ambre" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
    <!-- Blonde -->
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($imageBlonde) ?>" class="card-img-top" alt="Bière blonde">
            <div class="card-body">
                <h5 class="card-title">Bières Blondes</h5>
                <p class="card-text">Légères et rafraîchissantes.</p>
                <a href="index_.php?page=bieres&couleur=Blonde" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
    <!-- Sans alcool -->
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($imageSans) ?>" class="card-img-top" alt="Bière sans alcool">
            <div class="card-body">
                <h5 class="card-title">Sans alcool</h5>
                <p class="card-text">Le goût de la bière sans modération.</p>
                <a href="index_.php?page=bieres&sans_alcool=1" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
</div>