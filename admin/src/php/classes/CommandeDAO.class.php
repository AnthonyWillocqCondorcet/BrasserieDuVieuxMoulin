<?php
class CommandeDAO {
    private PDO $_cnx;
    public function __construct(PDO $cnx) { $this->_cnx = $cnx; }
    public function getAllCommandes() {
        $sql = "SELECT c.*, u.nom, u.prenom FROM Commande c JOIN Client cl ON c.id_client = cl.id_utilisateur JOIN Utilisateur u ON cl.id_utilisateur = u.id_utilisateur ORDER BY c.date_commande DESC";
        return $this->_cnx->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}