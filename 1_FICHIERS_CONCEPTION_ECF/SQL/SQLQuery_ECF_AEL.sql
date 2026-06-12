USE ECF_AEL_CDA;

GO

-----RENAME COLUMNS-----
--EXEC sp_rename 'MODELE.modèle véhicule', 'modele_vehic', 'COLUMN';
--EXEC sp_rename 'MODELE.année', 'annee', 'COLUMN';
--EXEC sp_rename 'MODELE.date achat', 'date_achat', 'COLUMN';

--EXEC sp_rename 'ELEVE.id élève', 'id_eleve', 'COLUMN';
--EXEC sp_rename 'ELEVE.nom élève', 'nom_eleve', 'COLUMN';
--EXEC sp_rename 'ELEVE.prénom élève', 'prenom_eleve', 'COLUMN';
--EXEC sp_rename 'ELEVE.date naissance', 'date_naissance_eleve', 'COLUMN';
--EXEC sp_rename 'ELEVE.date inscription', 'date_inscription', 'COLUMN';

--EXEC sp_rename 'LECON.modèle véhicule', 'lecon_modele_vehic', 'COLUMN';
--EXEC sp_rename 'LECON.date heure', 'lecon_date_heure', 'COLUMN';
--EXEC sp_rename 'LECON.id élève', 'lecon_eleve_id', 'COLUMN';
--EXEC sp_rename 'LECON.id moniteur', 'lecon_moniteur_id', 'COLUMN';
--EXEC sp_rename 'LECON.durée', 'duree', 'COLUMN';

--EXEC sp_rename 'CALENDRIER.date heure', 'date_heure', 'COLUMN';

--EXEC sp_rename 'MONITEUR.id moniteur', 'id_moniteur', 'COLUMN';
--EXEC sp_rename 'MONITEUR.nom moniteur', 'nom_moniteur', 'COLUMN';
--EXEC sp_rename 'MONITEUR.prénom moniteur', 'prenom_moniteur', 'COLUMN';
--EXEC sp_rename 'MONITEUR.date naissance', 'date_naissance_moniteur', 'COLUMN';
--EXEC sp_rename 'MONITEUR.date embauche', 'date_embauche', 'COLUMN';
--EXEC sp_rename 'MONITEUR.activité', 'activite', 'COLUMN';

--EXEC sp_rename 'VEHICULE.n°immatriculation', 'num_immatric', 'COLUMN';
--EXEC sp_rename 'VEHICULE.modèle véhicule', 'modele_vehic', 'COLUMN';
--EXEC sp_rename 'VEHICULE.état', 'etat', 'COLUMN';

--GO

-----ADD ID COLUMN TO LECON-----
--ALTER TABLE LECON DROP CONSTRAINT PK_LECON;
--ALTER TABLE LECON ADD id INT IDENTITY(1,1) NOT NULL;
--ALTER TABLE LECON ADD CONSTRAINT PK_LECON PRIMARY KEY (id);

--GO

-----ADD ID COLUMN TO CALENDRIER-----
--ALTER TABLE LECON DROP CONSTRAINT FK_lecon_calendrier;
--ALTER TABLE CALENDRIER DROP CONSTRAINT PK_CALENDRIER;
--ALTER TABLE CALENDRIER ADD id INT IDENTITY(1,1) NOT NULL;
--ALTER TABLE CALENDRIER ADD CONSTRAINT PK_CALENDRIER PRIMARY KEY (id);
--ALTER TABLE LECON ADD calendrier_id INT NULL;
--ALTER TABLE LECON ADD CONSTRAINT FK_lecon_calendrier 
--    FOREIGN KEY (calendrier_id) REFERENCES CALENDRIER(id);

--GO

-----DELETE FROM CALENDRIER-----
--DELETE FROM CALENDRIER;