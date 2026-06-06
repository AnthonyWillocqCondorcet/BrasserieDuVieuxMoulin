<?php
require_once "admin/src/php/classes/BiereDAO.class.php";
$biereDAO = new BiereDAO($cnx);
$couleur = $_GET['couleur'] ?? '';
$bieres = $biereDAO->getBieresByCouleur($couleur);
?>
<h2>Bières <?= htmlspecialchars($couleur) ?></h2>
<div class="row">
    <?php foreach ($bieres as $b): ?>
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <img src="<?= htmlspecialchars(getImageUrl($b['image'])) ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5><?= htmlspecialchars($b['nom']) ?></h5>
                    <p><?= number_format($b['prix'],2) ?> € - <?= $b['taux_alcool'] ?>%</p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (empty($bieres)) echo "<p>Aucune bière de cette couleur.</p>"; ?>
</div>