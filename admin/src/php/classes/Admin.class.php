<?php
declare(strict_types=1);

class Admin implements JsonSerializable
{
    public function __construct(
        public readonly int    $id_utilisateur,
        public readonly string $nom,
        public readonly string $prenom,
        public readonly string $email,
        public readonly string $mot_de_passe,
        public readonly string $date_inscription,
        public readonly string $type_utilisateur,
        public readonly string $niveau_acces
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}