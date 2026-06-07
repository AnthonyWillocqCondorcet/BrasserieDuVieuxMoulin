<?php
require '../src/php/utils/check_connexion.php';
$biereDAO = new BiereDAO($cnx);
$bieres = $biereDAO->getAllBieres();
?>
<h2>Gestion des bières</h2>
<table class="table table-striped" id="tableBieres">
    <thead>
    <tr><th>ID</th><th>Nom</th><th>Volume</th><th>Taux alcool</th><th>Couleur</th><th>Prix</th><th>Stock</th><th>Image</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($bieres as $b): ?>
        <tr data-id="<?= $b['id_biere'] ?>">
            <td><?= $b['id_biere'] ?></td>
            <td class="editable" data-field="nom"><?= htmlspecialchars($b['nom']) ?></td>
            <td class="editable" data-field="volume"><?= $b['volume'] ?></td>
            <td class="editable" data-field="taux_alcool"><?= $b['taux_alcool'] ?></td>
            <td class="editable" data-field="couleur"><?= htmlspecialchars($b['couleur']) ?></td>
            <td class="editable" data-field="prix"><?= $b['prix'] ?></td>
            <td class="editable" data-field="stock"><?= $b['stock'] ?></td>
            <td><?= htmlspecialchars($b['image']) ?></td>
            <td><button class="btn btn-danger btn-sm deleteBiere">Supprimer</button></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../assets/js/gestion_biere.js"></script>