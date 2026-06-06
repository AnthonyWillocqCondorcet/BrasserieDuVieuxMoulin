<?php
abstract class Utilisateur {
    public function __construct(
        public readonly int $id_utilisateur,
        public readonly string $nom,
        public readonly string $prenom,
        public readonly string $email,
        public readonly string $mot_de_passe,
        public readonly string $date_inscription,
        public readonly string $type_utilisateur
    ) {}
}