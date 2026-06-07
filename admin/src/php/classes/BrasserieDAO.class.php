<?php
class BrasserieDAO {
    private PDO $_cnx;
    public function __construct(PDO $cnx) {
        $this->_cnx = $cnx;
    }
    public function getAllBrasseries() {
        $sql = "SELECT id_brasserie, nom FROM Brasserie ORDER BY nom";
        $stmt = $this->_cnx->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>