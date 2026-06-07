<?php
require_once "admin/src/php/utils/all_includes.php";

$id_biere = $_GET['id'] ?? 0;
if (!$id_biere) {
    header("Location: index_.php?page=accueil");
    exit;
}

$biereDAO = new BiereDAO($cnx);
$stmt = $cnx->prepare("SELECT * FROM Biere WHERE id_biere = ?");
$stmt->execute([$id_biere]);
$biere = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$biere) {
    header("Location: index_.php?page=404");
    exit;
}
?>
<h2><?= htmlspecialchars($biere['nom']) ?></h2>
<div class="row">
    <div class="col-md-6">
        <img src="<?= htmlspecialchars(getImageUrl($biere['image'])) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($biere['nom']) ?>">

        <ul class="list-group">
            <li class="list-group-item"><strong>Volume :</strong> <?= $biere['volume'] ?> cl</li>
            <li class="list-group-item"><strong>Taux d'alcool :</strong> <?= $biere['taux_alcool'] ?> %</li>
            <li class="list-group-item"><strong>Couleur :</strong> <?= htmlspecialchars($biere['couleur']) ?></li>
            <li class="list-group-item"><strong>Prix :</strong> <?= number_format($biere['prix'], 2) ?> €</li>
            <li class="list-group-item"><strong>Stock :</strong> <?= $biere['stock'] ?></li>
        </ul>
        <a href="index_.php?page=accueil" class="btn btn-secondary mt-3">Retour</a>
    </div>
</div>