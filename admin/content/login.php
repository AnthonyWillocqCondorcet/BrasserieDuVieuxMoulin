<?php
if (isset($_GET['submit'])) {
    require '../src/php/classes/AdminDAO.class.php';
    $adminDAO = new AdminDAO($cnx);
    $adm = $adminDAO->getAdmin($_GET['login'], $_GET['password']);
    if ($adm) {
        $_SESSION['admin'] = $adm;
        header("Location: ../src/index_.php?page=accueil");
        exit;
    } else {
        $erreur = "Identifiants invalides";
    }
}
?>
<form method="get" action="">
    <div class="mb-3">
        <label for="login" class="form-label">Email</label>
        <input type="text" class="form-control" id="login" name="login">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Se connecter</button>
    <?php if (isset($erreur)) echo "<div class='alert alert-danger mt-2'>$erreur</div>"; ?>
</form>