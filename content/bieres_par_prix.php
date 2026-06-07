<?php
require_once "admin/src/php/classes/BiereDAO.class.php";
$biereDAO = new BiereDAO($cnx);
$ordre = $_GET['ordre'] ?? 'ASC';
$ordre = ($ordre == 'DESC') ? 'DESC' : 'ASC';
$bieres = $biereDAO->getBieresByPrix($ordre);
?>
<h2>Bières par prix <?= $ordre == 'ASC' ? 'croissant' : 'décroissant' ?>
    <a href="?page=bieres_par_prix&ordre=<?= $ordre == 'ASC' ? 'DESC' : 'ASC' ?>" class="btn btn-sm btn-secondary">Inverser</a>
</h2>
<div class="row">
    <?php foreach ($bieres as $b): ?>
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <img src="<?= htmlspecialchars(getImageUrl($b['image'])) ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5><?= htmlspecialchars($b['nom']) ?></h5>
                    <p><?= number_format($b['prix'],2) ?> € - <?= $b['taux_alcool'] ?>%</p>
                    <a href="index_.php?page=details_biere&id=<?= $b['id_biere'] ?>" class="btn btn-sm btn-outline-primary">Détails</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>