<?php
require_once "admin/src/php/classes/BiereDAO.class.php";
$biereDAO = new BiereDAO($cnx);

$ambree = $biereDAO->getBieresByCouleur('Ambre');
$imageAmbre = !empty($ambree) && !empty($ambree[0]['image']) ? $ambree[0]['image'] : null;
// Normalisation du chemin
if (!empty($imageAmbre)) {
    if (!filter_var($imageAmbre, FILTER_VALIDATE_URL)) {
        $imageAmbre = 'admin/assets/images/' . ltrim($imageAmbre, '/');
    }
} else {
    $imageAmbre = 'admin/assets/images/default.jpg';
}

$blonde = $biereDAO->getBieresByCouleur('Blonde');
$imageBlonde = !empty($blonde) && !empty($blonde[0]['image']) ? $blonde[0]['image'] : null;
if (!empty($imageBlonde)) {
    if (!filter_var($imageBlonde, FILTER_VALIDATE_URL)) {
        $imageBlonde = 'admin/assets/images/' . ltrim($imageBlonde, '/');
    }
} else {
    $imageBlonde = 'admin/assets/images/default.jpg';
}

$sansAlcool = $biereDAO->getBieresSansAlcool();
$imageSans = !empty($sansAlcool) && !empty($sansAlcool[0]['image']) ? $sansAlcool[0]['image'] : null;
if (!empty($imageSans)) {
    if (!filter_var($imageSans, FILTER_VALIDATE_URL)) {
        $imageSans = 'admin/assets/images/' . ltrim($imageSans, '/');
    }
} else {
    $imageSans = 'admin/assets/images/default.jpg';
}
?>

<h1>Bienvenue à la Brasserie du Vieux Moulin</h1>
<p>Découvrez nos bières artisanales brassées avec passion.</p>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($imageAmbre) ?>" class="card-img-top" alt="Bière ambrée" style="height:200px; object-fit:cover;">
            <div class="card-body">
                <h5 class="card-title">Bières Ambrées</h5>
                <p class="card-text">Couleur cuivrée, notes caramélisées.</p>
                <a href="index_.php?page=bieres_par_couleur&couleur=Ambre" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($imageBlonde) ?>" class="card-img-top" alt="Bière blonde" style="height:200px; object-fit:cover;">
            <div class="card-body">
                <h5 class="card-title">Bières Blondes</h5>
                <p class="card-text">Légères et rafraîchissantes.</p>
                <a href="index_.php?page=bieres_par_couleur&couleur=Blonde" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($imageSans) ?>" class="card-img-top" alt="Bière sans alcool" style="height:200px; object-fit:cover;">
            <div class="card-body">
                <h5 class="card-title">Sans alcool</h5>
                <p class="card-text">Le goût de la bière sans modération.</p>
                <a href="index_.php?page=bieres_sans_alcool" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
</div>