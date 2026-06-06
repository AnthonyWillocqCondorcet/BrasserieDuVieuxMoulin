<?php
class Commande {
    public function __construct(
        public readonly int $id_commande,
        public readonly string $date_commande,
        public readonly string $statut,
        public readonly float $montant_total,
        public readonly int $id_client,
        public readonly int $id_administrateur
    ) {}
}