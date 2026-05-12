<?php

class ClientDAO
{
    private PDO $_cnx;

    public function __construct(PDO $cnx)
    {
        $this->_cnx = $cnx;
    }

    public function getClient($email, $password)
    {
        $query = "SELECT u.id_utilisateur, u.email, u.mot_de_passe, u.nom, u.prenom,
                         c.date_naissance, c.id_adresse,
                         a.rue, a.numero, a.code_postal, a.ville, a.pays
                  FROM Utilisateur u
                  JOIN Client c ON u.id_utilisateur = c.id_utilisateur
                  JOIN Adresse a ON c.id_adresse = a.id_adresse
                  WHERE u.email = :email AND u.type_utilisateur = 'client'";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérification du mot de passe avec password_verify (car stocké hashé)
            if ($data && password_verify($password, $data['mot_de_passe'])) {
                return $data;
            }
            return null;
        } catch (PDOException $e) {

            error_log($e->getMessage());
            return null;
        }
    }

    public function addClient($email, $password, $nom, $prenom, $date_naissance, $rue, $numero, $code_postal, $ville, $pays)
    {
        try {
            $this->_cnx->beginTransaction();

            // 1. Insertion dans Utilisateur
            $query = "INSERT INTO Utilisateur (nom, prenom, email, mot_de_passe, date_inscription, type_utilisateur)
                  VALUES (:nom, :prenom, :email, :mot_de_passe, :date_inscription, :type_utilisateur)
                  RETURNING id_utilisateur";
            $stmtUtil = $this->_cnx->prepare($query);
            $stmtUtil->bindValue(':nom', $nom);
            $stmtUtil->bindValue(':prenom', $prenom);
            $stmtUtil->bindValue(':email', $email);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmtUtil->bindValue(':mot_de_passe', $hashedPassword);
            $date_inscription = date('Y-m-d');
            $stmtUtil->bindValue(':date_inscription', $date_inscription);
            $type_utilisateur = 'client';
            $stmtUtil->bindValue(':type_utilisateur', $type_utilisateur);
            $stmtUtil->execute();
            $id_utilisateur = $stmtUtil->fetchColumn();

            // 2. Insertion dans Adresse
            $query = "INSERT INTO Adresse (rue, numero, code_postal, ville, pays)
                  VALUES (:rue, :numero, :code_postal, :ville, :pays)
                  RETURNING id_adresse";
            $stmtAdr = $this->_cnx->prepare($query);
            $stmtAdr->bindValue(':rue', $rue);
            $stmtAdr->bindValue(':numero', $numero);
            $stmtAdr->bindValue(':code_postal', $code_postal);
            $stmtAdr->bindValue(':ville', $ville);
            $stmtAdr->bindValue(':pays', $pays);
            $stmtAdr->execute();
            $id_adresse = $stmtAdr->fetchColumn();

            // 3. Insertion dans Client
            $query = "INSERT INTO Client (id_utilisateur, date_naissance, id_adresse)
                  VALUES (:id_utilisateur, :date_naissance, :id_adresse)";
            $stmtClient = $this->_cnx->prepare($query);
            $stmtClient->bindValue(':id_utilisateur', $id_utilisateur);
            $stmtClient->bindValue(':date_naissance', $date_naissance);
            $stmtClient->bindValue(':id_adresse', $id_adresse);
            $stmtClient->execute();

            $this->_cnx->commit();
            return (int)$id_utilisateur;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            error_log($e->getMessage());
            return null;
        }
    }
}