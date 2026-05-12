<?php

declare(strict_types=1);

class Client implements JsonSerializable
{
    public function __construct(
        public readonly int    $id_utilisateur,
        public readonly string $email,
        public readonly string $mot_de_passe,
        public readonly string $nom,
        public readonly string $prenom,
        public readonly string $date_naissance,
        public readonly string $rue,
        public readonly string $numero,
        public readonly string $code_postal,
        public readonly string $ville,
        public readonly string $pays,
        public readonly int    $id_adresse
    ) {
    }

    /* Méthode qui sérialise l'objet construit pour la classe DAO, qui le retournera au fichier ajax */
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}