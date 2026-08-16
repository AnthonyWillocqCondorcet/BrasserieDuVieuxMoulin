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
        $stmt = $this->_cnx->prepare("SELECT delete_biere(:id)");
        $stmt->execute([':id' => $id_biere]);
        return (bool) $stmt->fetchColumn();
    }
    public function updateChampBiere($champ, $nouveau, $id_biere) {
        $stmt = $this->_cnx->prepare("SELECT update_champ_biere(:champ, :nouveau, :id)");
        $stmt->execute([':champ' => $champ, ':nouveau' => $nouveau, ':id' => $id_biere]);
        return (bool) $stmt->fetchColumn();
    }
    public function ajoutBiere($nom, $volume, $taux_alcool, $couleur, $prix, $stock, $image, $id_brasserie, $id_administrateur) {
        $stmt = $this->_cnx->prepare("SELECT ajout_biere(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $volume, $taux_alcool, $couleur, $prix, $stock, $image, $id_brasserie, $id_administrateur]);
        return $stmt->fetchColumn();
    }
}