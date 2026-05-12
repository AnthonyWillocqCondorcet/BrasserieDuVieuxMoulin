CREATE OR REPLACE FUNCTION ajouter_biere(
    p_nom TEXT,
    p_volume INT,
    p_taux_alcool DECIMAL(3,1),
    p_couleur TEXT,
    p_prix DECIMAL(10,2),
    p_stock INT,
    p_image TEXT,
    p_id_brasserie INT,
    p_id_administrateur INT
)
RETURNS INTEGER
LANGUAGE plpgsql
AS '
DECLARE
    retour INTEGER;
BEGIN
    INSERT INTO Biere(nom, volume, taux_alcool, couleur, prix, stock, image, id_brasserie, id_administrateur)
    VALUES (p_nom, p_volume, p_taux_alcool, p_couleur, p_prix, p_stock, p_image, p_id_brasserie, p_id_administrateur)
        ON CONFLICT (nom) DO NOTHING
        RETURNING id_biere INTO retour;

    IF retour IS NOT NULL THEN
            RETURN retour;
    END IF;

    RETURN -1;
END;
';