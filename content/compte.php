<?php
if (isset($_GET['submit_client'])) {
    require_once "admin/src/php/classes/ClientDAO.class.php";
    $clientDAO = new ClientDAO($cnx);
    $retour = $clientDAO->addClient(
            $_GET['email'], $_GET['password'], $_GET['nom'], $_GET['prenom'],
            $_GET['date_naissance'], $_GET['rue'], $_GET['numero'],
            $_GET['code_postal'], $_GET['ville'], $_GET['pays']
    );
    if ($retour) {
        echo "<div class='alert alert-success'>Inscription réussie ! Vous pouvez vous <a href='index_.php?page=login'>connecter</a>.</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'inscription. Vérifiez que l'email n'est pas déjà utilisé.</div>";
    }
}
?>
<form action="index_.php?page=compte" method="get" class="card p-4">
    <h3>Créer un compte client</h3>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="date_naissance" class="form-label">Date de naissance</label>
        <input type="date" class="form-control" name="date_naissance" id="date_naissance" required>
    </div>
    <div class="mb-3">
        <label for="rue" class="form-label">Rue</label>
        <input type="text" class="form-control" name="rue" id="rue" required>
    </div>
    <div class="mb-3">
        <label for="numero" class="form-label">Numéro</label>
        <input type="text" class="form-control" name="numero" id="numero" required>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="code_postal" class="form-label">Code postal</label>
            <input type="text" class="form-control" name="code_postal" id="code_postal" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" name="ville" id="ville" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="pays" class="form-label">Pays</label>
            <input type="text" class="form-control" name="pays" id="pays" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" name="submit_client">S'inscrire</button>
</form>