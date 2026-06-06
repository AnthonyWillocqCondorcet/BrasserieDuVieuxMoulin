<?php
require '../src/php/utils/check_connexion.php';
$commandeDAO = new CommandeDAO($cnx);
$commandes = $commandeDAO->getAllCommandes();
?>
<h2>Liste des commandes</h2>
<table class="table">
    <thead><tr><th>ID</th><th>Date</th><th>Statut</th><th>Montant total</th><th>Client</th><th>Action</th></tr>
    </thead>
    <tbody>
    <?php foreach ($commandes as $c): ?>
        <tr>
            <td><?= $c['id_commande'] ?></td>
            <td><?= $c['date_commande'] ?></td>
            <td><?= $c['statut'] ?></td>
            <td><?= $c['montant_total'] ?> €</td>
            <td><?= $c['nom'] ?> <?= $c['prenom'] ?></td>
            <td><a href="index_.php?page=detail_commande&id=<?= $c['id_commande'] ?>" class="btn btn-sm btn-info">Voir</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>