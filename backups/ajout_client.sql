CREATE OR REPLACE FUNCTION ajout_client(
    p_email text,
    p_mot_de_passe text,
    p_nom text,
    p_prenom text,
    p_date_naissance date,
    p_rue text,
    p_numero text,
    p_code_postal text,
    p_ville text,
    p_pays text
) RETURNS integer
AS
'
DECLARE
    v_id_utilisateur integer;
    v_id_adresse integer;
BEGIN
    INSERT INTO Utilisateur (email, mot_de_passe, nom, prenom, date_inscription, type_utilisateur)
    VALUES (p_email, p_mot_de_passe, p_nom, p_prenom, CURRENT_DATE, 'client')
        ON CONFLICT (email) DO NOTHING
        RETURNING id_utilisateur INTO v_id_utilisateur;

    IF v_id_utilisateur IS NULL THEN
            RETURN -1;
    END IF;

    INSERT INTO Adresse (rue, numero, code_postal, ville, pays)
    VALUES (p_rue, p_numero, p_code_postal, p_ville, p_pays)
        RETURNING id_adresse INTO v_id_adresse;

    INSERT INTO Client (id_utilisateur, date_naissance, id_adresse)
    VALUES (v_id_utilisateur, p_date_naissance, v_id_adresse);

    RETURN v_id_utilisateur;

EXCEPTION
    WHEN OTHERS THEN
        RETURN 0;
END;
'
LANGUAGE plpgsql;