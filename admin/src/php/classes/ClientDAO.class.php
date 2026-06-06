<?php
class ClientDAO {
    private PDO $_cnx;
    public function __construct(PDO $cnx) { $this->_cnx = $cnx; }
    public function getClient($email, $password) {
        $query = "SELECT u.id_utilisateur, u.email, u.mot_de_passe, u.nom, u.prenom,
                         c.date_naissance, c.id_adresse,
                         a.rue, a.numero, a.code_postal, a.ville, a.pays
                  FROM Utilisateur u
                  JOIN Client c ON u.id_utilisateur = c.id_utilisateur
                  JOIN Adresse a ON c.id_adresse = a.id_adresse
                  WHERE u.email = :email AND u.type_utilisateur = 'client'";
        $stmt = $this->_cnx->prepare($query);
        $stmt->execute([':email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data && password_verify($password, $data['mot_de_passe'])) {
            return $data;
        }
        return null;
    }
    public function addClient($email, $password, $nom, $prenom, $date_naissance, $rue, $numero, $code_postal, $ville, $pays) {
        try {
            $this->_cnx->beginTransaction();
            // Utilisateur
            $stmt = $this->_cnx->prepare("INSERT INTO Utilisateur (nom, prenom, email, mot_de_passe, date_inscription, type_utilisateur) VALUES (:nom, :prenom, :email, :password, NOW(), 'client') RETURNING id_utilisateur");
            $stmt->execute([':nom'=>$nom, ':prenom'=>$prenom, ':email'=>$email, ':password'=>password_hash($password, PASSWORD_DEFAULT)]);
            $id_util = $stmt->fetchColumn();
            // Adresse
            $stmt = $this->_cnx->prepare("INSERT INTO Adresse (rue, numero, code_postal, ville, pays) VALUES (:rue, :numero, :cp, :ville, :pays) RETURNING id_adresse");
            $stmt->execute([':rue'=>$rue, ':numero'=>$numero, ':cp'=>$code_postal, ':ville'=>$ville, ':pays'=>$pays]);
            $id_adr = $stmt->fetchColumn();
            // Client
            $stmt = $this->_cnx->prepare("INSERT INTO Client (id_utilisateur, date_naissance, id_adresse) VALUES (:id_util, :date_nais, :id_adr)");
            $stmt->execute([':id_util'=>$id_util, ':date_nais'=>$date_naissance, ':id_adr'=>$id_adr]);
            $this->_cnx->commit();
            return $id_util;
        } catch (Exception $e) {
            $this->_cnx->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }
}