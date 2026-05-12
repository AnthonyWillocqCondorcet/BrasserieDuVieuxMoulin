CREATE OR REPLACE FUNCTION update_champ_biere(p_champ TEXT, p_valeur TEXT, p_id INT)
RETURNS INTEGER
LANGUAGE plpgsql
AS
'
BEGIN
    EXECUTE format(''UPDATE Biere SET %I = %L WHERE id_biere = %L'', p_champ, p_valeur, p_id);
    RETURN 1;
END;
';