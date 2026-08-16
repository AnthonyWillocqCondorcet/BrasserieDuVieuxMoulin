CREATE OR REPLACE FUNCTION ajout_biere(
    p_nom TEXT,
    p_volume REAL,
    p_taux_alcool REAL,
    p_couleur TEXT,
    p_prix NUMERIC,
    p_stock INTEGER,
    p_image TEXT,
    p_id_brasserie INTEGER,
    p_id_administrateur INTEGER
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO Biere (nom, volume, taux_alcool, couleur, prix, stock, image, id_brasserie, id_administrateur)
    VALUES (p_nom, p_volume, p_taux_alcool, p_couleur, p_prix, p_stock, p_image, p_id_brasserie, p_id_administrateur)
    RETURNING id_biere INTO new_id;
    RETURN new_id;
END;
$$ LANGUAGE plpgsql;