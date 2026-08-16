CREATE OR REPLACE FUNCTION delete_biere(p_id_biere INTEGER)
RETURNS BOOLEAN AS $$
DECLARE
    rows_deleted INTEGER;
BEGIN
    -- Supprimer d'abord les liens dans est_vendu
    DELETE FROM est_vendu WHERE id_biere = p_id_biere;
    -- Puis supprimer la bière
    DELETE FROM Biere WHERE id_biere = p_id_biere;
    GET DIAGNOSTICS rows_deleted = ROW_COUNT;
    RETURN rows_deleted > 0;
EXCEPTION
    WHEN OTHERS THEN
        RETURN FALSE;
END;
$$ LANGUAGE plpgsql;