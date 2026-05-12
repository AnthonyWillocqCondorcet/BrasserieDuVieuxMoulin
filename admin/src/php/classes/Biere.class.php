<?php


declare(strict_types=1);

class Biere
{
    public function __construct(
        public readonly int     $id_biere,
        public readonly string  $nom,
        public readonly int     $volume,
        public readonly float   $taux_alcool,
        public readonly string  $couleur,
        public readonly float   $prix,
        public readonly int     $stock,
        public readonly ?string $image,
        public readonly int     $id_brasserie,
        public readonly int     $id_administrateur
    )
    {
    }
}