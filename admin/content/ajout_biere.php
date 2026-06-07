<?php
require '../src/php/utils/check_connexion.php';
require '../src/php/classes/BrasserieDAO.class.php';

$message = '';
$messageType = '';

// Récupérer la liste des brasseries pour le select
$brasserieDAO = new BrasserieDAO($cnx);
$brasseries = $brasserieDAO->getAllBrasseries();

if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'] ?? '';
    $volume = $_POST['volume'] ?? '';
    $taux_alcool = $_POST['taux_alcool'] ?? '';
    $couleur = $_POST['couleur'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $id_brasserie = $_POST['id_brasserie'] ?? 0;
    $id_admin = $_SESSION['admin']['id_utilisateur'];

    // Gestion de l'upload d'image
    $imageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid('biere_') . '.' . $extension;
        $destination = $uploadDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            // Succès
        } else {
            $message = "Erreur lors de l'upload de l'image.";
            $messageType = "danger";
        }
    } else {
        $message = "Veuillez sélectionner une image.";
        $messageType = "danger";
    }

    if (empty($message)) {
        $biereDAO = new BiereDAO($cnx);
        $retour = $biereDAO->ajoutBiere(
                $nom, $volume, $taux_alcool, $couleur,
                $prix, $stock, $imageName, $id_brasserie, $id_admin
        );
        if ($retour) {
            $message = "Bière ajoutée avec succès (ID $retour)";
            $messageType = "success";
        } else {
            $message = "Erreur lors de l'ajout en base.";
            $messageType = "danger";
        }
    }
}
?>
<h2>Ajouter une bière</h2>
<?php if ($message): ?>
    <div class="alert alert-<?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Volume (cl)</label>
        <input type="number" name="volume" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Taux d'alcool (%)</label>
        <input type="number" step="0.1" name="taux_alcool" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Couleur</label>
        <input type="text" name="couleur" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Prix (€)</label>
        <input type="number" step="0.01" name="prix" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Image (fichier)</label>
        <input type="file" name="image" class="form-control" accept="image/*" required>
    </div>
    <div class="mb-3">
        <label>Brasserie</label>
        <select name="id_brasserie" class="form-select" required>
            <option value="">Choisissez une brasserie</option>
            <?php foreach ($brasseries as $b): ?>
                <option value="<?= $b['id_brasserie'] ?>"><?= htmlspecialchars($b['nom']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" name="ajouter" class="btn btn-success">Ajouter</button>
</form>