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
<script>
    $(function(){
        $('.editable').dblclick(function(){
            var td = $(this);
            var champ = td.data('field');
            var ancien = td.text().trim();
            var id = td.closest('tr').data('id');
            var input = $('<input type="text" class="form-control form-control-sm" value="'+ancien+'">');
            td.html(input);
            input.focus().blur(function(){
                var nouveau = input.val();
                $.get('../src/php/ajax/ajaxUpdateBiere.php', {champ: champ, nouveau: nouveau, id_biere: id}, function(data){
                    if(data === true) td.text(nouveau);
                    else td.text(ancien);
                });
            });
        });
        $('.deleteBiere').click(function(){
            if(confirm('Supprimer cette bière ?')){
                var id = $(this).closest('tr').data('id');
                $.get('../src/php/ajax/ajaxDeleteBiere.php', {id_biere: id}, function(){
                    location.reload();
                });
            }
        });
    });
</script>