-- Table Utilisateur (table parente)
CREATE TABLE Utilisateur(
   id_utilisateur SERIAL PRIMARY KEY,
   nom TEXT NOT NULL,
   prenom TEXT NOT NULL,
   email TEXT NOT NULL UNIQUE,
   mot_de_passe TEXT NOT NULL,
   date_inscription DATE NOT NULL,
   type_utilisateur TEXT NOT NULL CHECK (type_utilisateur IN ('client', 'administrateur'))
);

-- Table Administrateur (avec FK vers Utilisateur)
CREATE TABLE Administrateur(
   id_utilisateur INT PRIMARY KEY REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
   niveau_acces TEXT NOT NULL UNIQUE
);

-- Table Adresse
CREATE TABLE Adresse(
   id_adresse SERIAL PRIMARY KEY,
   rue TEXT NOT NULL,
   numero TEXT NOT NULL,
   code_postal TEXT NOT NULL,
   ville TEXT NOT NULL,
   pays TEXT NOT NULL
);

-- Table Brasserie
CREATE TABLE Brasserie(
   id_brasserie SERIAL PRIMARY KEY,
   nom TEXT NOT NULL UNIQUE,
   id_adresse INT NOT NULL REFERENCES Adresse(id_adresse)
);

-- Table Biere (type CURRENCY remplacé par DECIMAL)
CREATE TABLE Biere(
   id_biere SERIAL PRIMARY KEY,
   nom TEXT NOT NULL UNIQUE,
   volume INT NOT NULL,
   taux_alcool DECIMAL(3,1) NOT NULL,
   couleur TEXT NOT NULL,
   prix DECIMAL(10,2) NOT NULL CHECK (prix >= 0),
   stock INT NOT NULL CHECK (stock >= 0),
   image TEXT,
   id_brasserie INT NOT NULL REFERENCES Brasserie(id_brasserie),
   id_administrateur INT NOT NULL REFERENCES Administrateur(id_utilisateur)
);

-- Table Client (avec FK vers Utilisateur)
CREATE TABLE Client(
   id_utilisateur INT PRIMARY KEY REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
   date_naissance DATE NOT NULL,
   id_adresse INT NOT NULL REFERENCES Adresse(id_adresse)
);

-- Table Commande (correction des clés étrangères)
CREATE TABLE Commande(
   id_commande SERIAL PRIMARY KEY,
   date_commande DATE NOT NULL DEFAULT CURRENT_DATE,
   statut TEXT NOT NULL CHECK (statut IN ('en_attente', 'confirmée', 'expédiée', 'livrée', 'annulée')),
   montant_total DECIMAL(10,2) NOT NULL CHECK (montant_total >= 0),
   id_client INT NOT NULL REFERENCES Client(id_utilisateur),
   id_administrateur INT NOT NULL REFERENCES Administrateur(id_utilisateur)
);

-- Table Avis (correction des clés étrangères)
CREATE TABLE Avis(
   id_avis SERIAL PRIMARY KEY,
   note INT NOT NULL CHECK (note BETWEEN 1 AND 5),
   commentaire TEXT,
   date_avis DATE NOT NULL DEFAULT CURRENT_DATE,
   id_administrateur INT NOT NULL REFERENCES Administrateur(id_utilisateur),
   id_biere INT NOT NULL REFERENCES Biere(id_biere),
   id_client INT NOT NULL REFERENCES Client(id_utilisateur)
);

-- Table est_vendu (association Biere-Commande)
CREATE TABLE est_vendu(
   id_biere INT NOT NULL,
   id_commande INT NOT NULL,
   quantite INT NOT NULL CHECK (quantite > 0),
   PRIMARY KEY(id_biere, id_commande),
   FOREIGN KEY(id_biere) REFERENCES Biere(id_biere),
   FOREIGN KEY(id_commande) REFERENCES Commande(id_commande)
);