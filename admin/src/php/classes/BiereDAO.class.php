<?php
class BiereDAO {
    private PDO $_cnx;
    public function __construct(PDO $cnx) { $this->_cnx = $cnx; }
    public function getAllBieres() {
        return $this->_cnx->query("SELECT * FROM Biere")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBieresByCouleur($couleur) {
        $stmt = $this->_cnx->prepare("SELECT * FROM Biere WHERE couleur = :couleur");
        $stmt->execute([':couleur' => $couleur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBieresByPrix($ordre = 'ASC') {
        $ordre = ($ordre === 'DESC') ? 'DESC' : 'ASC';
        return $this->_cnx->query("SELECT * FROM Biere ORDER BY prix $ordre")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBieresSansAlcool() {
        return $this->_cnx->query("SELECT * FROM Biere WHERE taux_alcool = 0")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteBiere($id_biere) {
        try {
            $this->_cnx->beginTransaction();
            $this->_cnx->prepare("DELETE FROM est_vendu WHERE id_biere = ?")->execute([$id_biere]);
            $stmt = $this->_cnx->prepare("DELETE FROM Biere WHERE id_biere = ?");
            $res = $stmt->execute([$id_biere]);
            $this->_cnx->commit();
            return $res;
        } catch (Exception $e) {
            $this->_cnx->rollBack();
            return false;
        }
    }
    public function updateChampBiere($champ, $nouveau, $id_biere) {
        $colonnes = ['nom','volume','taux_alcool','couleur','prix','stock','image','id_brasserie','id_administrateur'];
        if (!in_array($champ, $colonnes)) return false;
        $sql = "UPDATE Biere SET $champ = :val WHERE id_biere = :id";
        $stmt = $this->_cnx->prepare($sql);
        return $stmt->execute([':val' => $nouveau, ':id' => $id_biere]);
    }
    public function ajoutBiere($nom, $volume, $taux_alcool, $couleur, $prix, $stock, $image, $id_brasserie, $id_administrateur) {
        $sql = "INSERT INTO Biere (nom, volume, taux_alcool, couleur, prix, stock, image, id_brasserie, id_administrateur) VALUES (?,?,?,?,?,?,?,?,?) RETURNING id_biere";
        $stmt = $this->_cnx->prepare($sql);
        $stmt->execute([$nom, $volume, $taux_alcool, $couleur, $prix, $stock, $image, $id_brasserie, $id_administrateur]);
        return $stmt->fetchColumn();
    }
}