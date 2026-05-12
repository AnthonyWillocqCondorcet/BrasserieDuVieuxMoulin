<?php

if(isset($_GET['submit_client'])){
    print "coucou<br>";
    extract($_GET, EXTR_OVERWRITE);
    if(!empty($email) && !empty($password) && !empty($nom) && !empty($prenom)
        && !empty($date_naissance) && !empty($rue) && !empty($numero)
        && !empty($code_postal) && !empty($ville) && !empty($pays))
    {
        $clientDAO = new ClientDAO($cnx);
        $retour = $clientDAO->addClient($email, $password, $nom, $prenom,
            $date_naissance, $rue, $numero,
            $code_postal, $ville, $pays);
        if($retour != null){
            print "<br>Success<br>";
        } else {
            print "<br>Erreur lors de l'ajout<br>";
        }
    } else {
        print "<br>Veuillez remplir tous les champs.<br>";
    }
}
?>

<form action="<?=$_SERVER['PHP_SELF'];?>" method="get">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom" required>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom" id="prenom" required>
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
        <label for="numero" class="form-label">Numéro (rue)</label>
        <input type="text" class="form-control" name="numero" id="numero" required>
    </div>
    <div class="mb-3">
        <label for="code_postal" class="form-label">Code postal</label>
        <input type="text" class="form-control" name="code_postal" id="code_postal" required>
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Ville</label>
        <input type="text" class="form-control" name="ville" id="ville" required>
    </div>
    <div class="mb-3">
        <label for="pays" class="form-label">Pays</label>
        <input type="text" class="form-control" name="pays" id="pays" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit_client" id="submit_client">Ajouter ou modifier</button>
    <button type="reset" class="btn btn-primary">Annuler</button>
</form>