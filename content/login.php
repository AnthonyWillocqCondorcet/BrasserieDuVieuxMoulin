<?php
require_once "admin/src/php/classes/ClientDAO.class.php";
require_once "admin/src/php/classes/AdminDAO.class.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $erreur = '';

    // 1. Essayer de connecter un client
    $clientDAO = new ClientDAO($cnx);
    $client = $clientDAO->getClient($email, $password);
    if ($client) {
        $_SESSION['client'] = $client;
        header("Location: index_.php?page=accueil");
        exit;
    }

    // 2. Sinon, essayer de connecter un administrateur
    $adminDAO = new AdminDAO($cnx);
    $admin = $adminDAO->getAdmin($email, $password);
    if ($admin) {
        $_SESSION['admin'] = $admin;
        header("Location: admin/src/index_.php");
        exit;
    }

    // 3. Aucun compte trouvé
    $erreur = "Email ou mot de passe incorrect";
}
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h3 class="text-center mb-4">Connexion</h3>
            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Se connecter</button>
            </form>
            <div class="text-center mt-3">
                <a href="index_.php?page=compte">Créer un compte client</a>
            </div>
        </div>
    </div>
</div>