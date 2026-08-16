<?php
require_once "admin/src/php/classes/BiereDAO.class.php";
$biereDAO = new BiereDAO($cnx);

// Déterminer le type de requête
$titre = "Nos bières";
$bieres = [];
$lienInverse = null;

if (isset($_GET['couleur']) && !empty($_GET['couleur'])) {
    $couleur = htmlspecialchars($_GET['couleur']);
    $bieres = $biereDAO->getBieresByCouleur($couleur);
    $titre = "Bières $couleur";
} elseif (isset($_GET['sans_alcool']) && $_GET['sans_alcool'] == 1) {
    $bieres = $biereDAO->getBieresSansAlcool();
    $titre = "Bières sans alcool";
} elseif (isset($_GET['prix'])) {
    $ordre = ($_GET['prix'] == 'DESC') ? 'DESC' : 'ASC';
    $bieres = $biereDAO->getBieresByPrix($ordre);
    $titre = "Bières par prix " . ($ordre == 'ASC' ? 'croissant' : 'décroissant');
    $ordreInverse = ($ordre == 'ASC') ? 'DESC' : 'ASC';
    $lienInverse = "index_.php?page=bieres&prix=$ordreInverse";
} else {
    // Par défaut : toutes les bières
    $bieres = $biereDAO->getAllBieres();
    $titre = "Toutes nos bières";
}
?>

<h2>
    <?= $titre ?>
    <?php if ($lienInverse): ?>
        <a href="<?= $lienInverse ?>" class="btn btn-sm btn-secondary">Inverser</a>
    <?php endif; ?>
</h2>

<div class="row">
    <?php if (empty($bieres)): ?>
        <p>Aucune bière trouvée.</p>
    <?php else: ?>
        <?php foreach ($bieres as $b): ?>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <img src="<?= htmlspecialchars(getImageUrl($b['image'])) ?>" class="card-img-top" alt="<?= htmlspecialchars($b['nom']) ?>">
                    <div class="card-body">
                        <h5><?= htmlspecialchars($b['nom']) ?></h5>
                        <p><?= number_format($b['prix'], 2) ?> € - <?= $b['taux_alcool'] ?>%</p>
                        <a href="index_.php?page=details_biere&id=<?= $b['id_biere'] ?>" class="btn btn-sm btn-outline-primary">Détails</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>