<?php
require '../src/php/utils/check_connexion.php';
?>
<h2>Accueil administration</h2>
<p>Bienvenue dans l'espace administrateur.</p>
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Gestion des bières</h5>
                <a href="index_.php?page=gestion_biere" class="btn btn-primary">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Commandes</h5>
                <a href="index_.php?page=liste_commandes" class="btn btn-primary">Voir</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Ajouter une bière</h5>
                <a href="index_.php?page=ajout_biere" class="btn btn-primary">Ajouter</a>
            </div>
        </div>
    </div>
</div>