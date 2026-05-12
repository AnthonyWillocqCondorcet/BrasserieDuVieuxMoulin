<?php

class BiereDAO
{
    private PDO $_cnx;

    public function __construct(PDO $cnx)
    {
        $this->_cnx = $cnx;
    }

    public function deleteBiere($id_biere)
    {
        try {
            $this->_cnx->beginTransaction();

            // 1. Supprimer les lignes liées dans est_vendu
            $queryEstVendu = "DELETE FROM est_vendu WHERE id_biere = :id_biere";
            $stmt = $this->_cnx->prepare($queryEstVendu);
            $stmt->bindValue(':id_biere', $id_biere, PDO::PARAM_INT);
            $stmt->execute();

            // 2. Supprimer la bière
            $queryBiere = "DELETE FROM Biere WHERE id_biere = :id_biere";
            $stmt = $this->_cnx->prepare($queryBiere);
            $stmt->bindValue(':id_biere', $id_biere, PDO::PARAM_INT);
            $stmt->execute();

            $this->_cnx->commit();
            return true;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            error_log("Erreur suppression bière : " . $e->getMessage());
            return false;
        }
    }

    public function updateChampBiere($champ, $nouveau, $id_biere)
    {
        // Liste des colonnes autorisées pour la table Biere
        $colonnesAutorisees = [
            'nom', 'volume', 'taux_alcool', 'couleur', 'prix', 'stock', 'image',
            'id_brasserie', 'id_administrateur'
        ];
        if (!in_array($champ, $colonnesAutorisees)) {
            error_log("Champ non autorisé : $champ");
            return false;
        }

        $query = "UPDATE Biere SET $champ = :nouveau WHERE id_biere = :id_biere";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':nouveau', $nouveau);
            $stmt->bindValue(':id_biere', $id_biere, PDO::PARAM_INT);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            $this->_cnx->commit();
            return $rowCount > 0;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            error_log("Erreur mise à jour bière : " . $e->getMessage());
            return false;
        }
    }

    public function ajoutBiere($nom, $volume, $taux_alcool, $couleur, $prix, $stock, $image, $id_brasserie, $id_administrateur)
    {
        $query = "INSERT INTO Biere (nom, volume, taux_alcool, couleur, prix, stock, image, id_brasserie, id_administrateur)
                  VALUES (:nom, :volume, :taux_alcool, :couleur, :prix, :stock, :image, :id_brasserie, :id_administrateur)
                  RETURNING id_biere";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':volume', $volume, PDO::PARAM_INT);
            $stmt->bindValue(':taux_alcool', $taux_alcool);
            $stmt->bindValue(':couleur', $couleur);
            $stmt->bindValue(':prix', $prix);
            $stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':id_brasserie', $id_brasserie, PDO::PARAM_INT);
            $stmt->bindValue(':id_administrateur', $id_administrateur, PDO::PARAM_INT);
            $stmt->execute();
            $id_biere = $stmt->fetchColumn();
            $this->_cnx->commit();
            return $id_biere ? (int)$id_biere : false;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            error_log("Erreur ajout bière : " . $e->getMessage());
            return false;
        }
    }
}