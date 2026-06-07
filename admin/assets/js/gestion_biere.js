$(function() {
    // Édition en double-clic
    $('.editable').dblclick(function() {
        var td = $(this);
        var champ = td.data('field');
        var ancien = td.text().trim();
        var id = td.closest('tr').data('id');
        var input = $('<input type="text" class="form-control form-control-sm" value="' + ancien.replace(/"/g, '&quot;') + '">');
        td.html(input);
        input.focus().blur(function() {
            var nouveau = input.val();
            $.ajax({
                url: '../src/php/ajax/ajaxUpdateBiere.php',
                method: 'GET',
                data: { champ: champ, nouveau: nouveau, id_biere: id },
                success: function(data) {
                    if (data === "true" || data === true) {
                        td.text(nouveau);
                    } else {
                        td.text(ancien);
                        alert('Erreur lors de la mise à jour');
                    }
                },
                error: function() {
                    td.text(ancien);
                    alert('Erreur réseau');
                }
            });
        });
    });

    // Suppression
    $('.deleteBiere').click(function() {
        if (confirm('Supprimer cette bière ?')) {
            var id = $(this).closest('tr').data('id');
            $.ajax({
                url: '../src/php/ajax/ajaxDeleteBiere.php',
                method: 'GET',
                data: { id_biere: id },
                success: function(data) {
                    if (data === "ok") {
                        location.reload();
                    } else {
                        alert('Erreur : ' + data);
                    }
                },
                error: function() {
                    alert('Erreur réseau');
                }
            });
        }
    });
});