<?php
class Avis {
    public function __construct(
        public readonly int $id_avis,
        public readonly int $note,
        public readonly ?string $commentaire,
        public readonly string $date_avis,
        public readonly int $id_administrateur,
        public readonly int $id_biere,
        public readonly int $id_client
    ) {}
}