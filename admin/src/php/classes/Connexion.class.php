<?php
class Connexion {
    public static function getInstance($dsn, $user, $pass): ?PDO {
        try {
            return new PDO($dsn, $user, $pass);
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}