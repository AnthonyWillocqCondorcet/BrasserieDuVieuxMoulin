<?php
require '../src/php/utils/check_connexion.php';
if (isset($_POST['ajouter'])) {
    $biereDAO = new BiereDAO($cnx);
    $retour = $biereDAO->ajoutBiere(
        $_POST['nom'], $_POST['volume'], $_POST['taux_alcool'], $_POST['couleur'],
        $_POST['prix'], $_POST['stock'], $_POST['image'], $_POST['id_brasserie'], $_SESSION['admin']['id_utilisateur']
    );
    echo $retour ? "<div class='alert alert-success'>Bière ajoutée (id $retour)</div>" : "<div class='alert alert-danger'>Erreur</div>";
}
?>
<h2>Ajouter une bière</h2>
<form method="post">
    <div class="mb-3"><label>Nom</label><input type="text" name="nom" class="form-control" required></div>
    <div class="mb-3"><label>Volume (cl)</label><input type="number" name="volume" class="form-control" required></div>
    <div class="mb-3"><label>Taux d'alcool (%)</label><input type="number" step="0.1" name="taux_alcool" class="form-control" required></div>
    <div class="mb-3"><label>Couleur</label><input type="text" name="couleur" class="form-control" required></div>
    <div class="mb-3"><label>Prix (€)</label><input type="number" step="0.01" name="prix" class="form-control" required></div>
    <div class="mb-3"><label>Stock</label><input type="number" name="stock" class="form-control" required></div>
    <div class="mb-3"><label>URL image</label><input type="text" name="image" class="form-control"></div>
    <div class="mb-3"><label>ID Brasserie</label><input type="number" name="id_brasserie" class="form-control" required></div>
    <button type="submit" name="ajouter" class="btn btn-success">Ajouter</button>
</form>