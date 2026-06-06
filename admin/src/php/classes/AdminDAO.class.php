<?php
class AdminDAO {
    private PDO $_cnx;
    public function __construct(PDO $cnx) { $this->_cnx = $cnx; }
    public function getAdmin($email, $password) {
        $sql = "SELECT u.*, a.niveau_acces
                FROM Utilisateur u
                JOIN Administrateur a ON u.id_utilisateur = a.id_utilisateur
                WHERE u.email = :email AND u.type_utilisateur = 'administrateur'";
        $stmt = $this->_cnx->prepare($sql);
        $stmt->execute([':email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data && password_verify($password, $data['mot_de_passe'])) {
            return $data;
        }
        return null;
    }
}